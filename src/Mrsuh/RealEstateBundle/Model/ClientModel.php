<?php namespace Mrsuh\RealEstateBundle\Model;

use Mrsuh\RealEstateBundle\C;
use Mrsuh\RealEstateBundle\Exception\ValidationException;
use Mrsuh\RealEstateBundle\Service\CommonFunction;

class ClientModel
{
    private $paramRepo;
    private $clientRepo;
    private $clientRegionCityRepo;
    private $regionCityRepo;
    private $em;

    public function __construct($em)
    {
        $this->clientRepo = $em->getRepository(C::REPO_CLIENT);
        $this->advertRepo = $em->getRepository(C::REPO_ADVERT);
        $this->clientAdvertRepo = $em->getRepository(C::REPO_CLIENT_ADVERT);
        $this->clientRegionCityRepo = $em->getRepository(C::REPO_CLIENT_REGION_CITY);
        $this->regionCityRepo = $em->getRepository(C::REPO_ADDRESS_REGION_CITY);
        $this->em = $em;
        $this->paramRepo = [
            'object_type' => $em->getRepository(C::REPO_OBJECT_TYPE),
            'city' => $em->getRepository(C::REPO_ADDRESS_CITY),
        ];
    }

    public function getClientParams()
    {
        $params = [];
        foreach ($this->paramRepo as $k => $r) {
            foreach ($r->findAll() as $obj) {
                if (!array_key_exists($k, $params)) {
                    $params[$k] = [];
                }
                $params[$k][$obj->getId()] = $obj->getName();
            }
        }

        return $params;
    }

    public function setClientParams($params)
    {
        foreach ($params as $k => $v) {
            if (array_key_exists($k, $this->paramRepo)) {
                $repo = $this->paramRepo[$k];
                $params[$k] = $repo->findOneById($v);
            }
        }

        $params['birth_day'] = CommonFunction::stringToDateTime($params['birth_day']);

        return $params;
    }

    public function create($params, $user)
    {
        if ($this->clientRepo->existClientByPhone($params['phone1'])) {
            throw new ValidationException('Клиент с телефоном ' . $params['phone1'] . ' уже существует');
        };

        if (isset($params['birth_day'])) {
            if($params['birth_day'] > (new \DateTime())){
                throw new ValidationException('Неверно указана дата рождения клиента');
            }
        };

        $params['price_from'] = str_replace(',', '', $params['price_from']);
        $params['price_to'] = str_replace(',', '', $params['price_to']);

        $this->em->beginTransaction();
        try {
            $params['user'] = $user;
            $client = $this->clientRepo->create($params);
            if (isset($params['region_city'])) {
                foreach ($params['region_city'] as $k => $v) {
                    $regionCity = $this->regionCityRepo->findOneById($k);
                    $this->clientRegionCityRepo->create($client, $regionCity);
                }
            }

            $this->em->flush();
            $this->em->commit();
        } catch (\Exception $e) {
            $this->em->rollback();
            throw $e;
        }

        return $client;
    }

    public function update($client, $params)
    {
        $this->em->beginTransaction();
        try {
            $params['price_from'] = str_replace(',', '', $params['price_from']);
            $params['price_to'] = str_replace(',', '', $params['price_to']);
            $this->clientRepo->update($client, $params);

            if (isset($params['region_city'])) {

                foreach ($this->clientRegionCityRepo->findByClient($client) as $r) {
                    $this->clientRegionCityRepo->delete($r);
                }

                foreach ($params['region_city'] as $k => $v) {
                    $regionCity = $this->regionCityRepo->findOneById($k);
                    if ($regionCity) {
                        $this->clientRegionCityRepo->create($client, $regionCity);
                    }
                }
            }

            if (isset($params['reviewed_adverts'])) {
                foreach (explode(',', $params['reviewed_adverts']) as $o) {
                    $advert = $this->advertRepo->findOneById(trim($o));
                    if ($advert && !$this->clientAdvertRepo->findOneBy(['client' => $client, 'advert' => $advert])) {
                        $this->clientAdvertRepo->create($client, $advert);
                    }
                }
            }

            $this->em->flush();
            $this->em->commit();
        } catch (\Exception $e) {
            $this->em->rollback();
            throw $e;
        }

        return $client;
    }


    public function getOneById($id)
    {
        return $this->clientRepo->findOneById($id);
    }

    public function findByParams($params)
    {
        return CommonFunction::paginate($this->clientRepo->findByParams($params), ['current_page' => $params['pagination_page'], 'items_on_page' => $params['pagination_items_on_page']]);
    }

    public function getRegionCityByClientId($id)
    {
        $array = [];
        foreach ($this->clientRegionCityRepo->findByClient($id) as $r) {
            $array[] = $r->getRegionCity()->getId();
        }

        return $array;
    }

    public function getReviewedAdvertsByClient($client)
    {
        $adverts = [];
        foreach ($this->clientAdvertRepo->findByClient($client) as $o) {
            $adverts[] = $o->getAdvert();
        }

        return $adverts;
    }
}