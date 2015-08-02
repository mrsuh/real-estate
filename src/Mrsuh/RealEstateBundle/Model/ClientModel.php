<?php namespace Mrsuh\RealEstateBundle\Model;

use Mrsuh\RealEstateBundle\C;
use Mrsuh\RealEstateBundle\Service\CommonFunction;

class ClientModel
{
    private $paramRepo;
    private $clientRepo;
    private $em;

    public function __construct($em)
    {
        $this->clientRepo = $em->getRepository(C::REPO_CLIENT);
        $this->em = $em;
        $this->paramRepo = [
            'object_type' => $em->getRepository(C::REPO_OBJECT_TYPE),
            'city' => $em->getRepository(C::REPO_ADDRESS_CITY),
            'region_city' => $em->getRepository(C::REPO_ADDRESS_REGION_CITY),
        ];
    }

    public function getClientParams()
    {
        $params = [];
        foreach($this->paramRepo as $k => $r) {
            foreach($r->findAll() as $obj) {
                if(!array_key_exists($k, $params)) {
                    $params[$k] = [];
                }
                $params[$k][$obj->getId()] = $obj->getName();
            }
        }

        return $params;
    }

    public function setClientParams($params){
        foreach($params as $k => $v) {
            if(array_key_exists($k, $this->paramRepo)) {
                $repo = $this->paramRepo[$k];
                $params[$k] = $repo->findOneById($v);
            }
        }

        $params['birth_day'] = CommonFunction::stringToDateTime($params['birth_day']);

        return $params;
    }

    public function create($params, $user)
    {
        $this->em->beginTransaction();
        try{

            $params['user'] = $user;
            $this->clientRepo->create($params);

            $this->em->flush();
            $this->em->commit();
        } catch(\Exception $e){
            $this->em->rollback();
            throw $e;
        }
    }

    public function getOneById($id)
    {
        return $this->clientRepo->findOneById($id);
    }

    public function findByParam()
    {
        return $this->clientRepo->findAll();
    }

}