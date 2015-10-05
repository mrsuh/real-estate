<?php namespace Mrsuh\RealEstateBundle\Controller;

use Mrsuh\RealEstateBundle\Exception\ValidationException;
use Mrsuh\RealEstateBundle\Form\Advert\ChangeUserAdvertListForm;
use Mrsuh\RealEstateBundle\Form\Advert\CreateAdvertForm;
use Mrsuh\RealEstateBundle\Form\Advert\FindAdvertByClientForm;
use Mrsuh\RealEstateBundle\Form\Advert\FindAdvertForm;
use Mrsuh\RealEstateBundle\Form\Advert\EditAdvertForm;
use Mrsuh\RealEstateBundle\Service\CommonFunction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mrsuh\RealEstateBundle\C;

class AdvertController extends Controller
{
    public function createAdvertAction(Request $request)
    {
        $modelAdvert = $this->get('model.advert');

        $params = $modelAdvert->getAdvertParams();
        $form = $this->createForm(new CreateAdvertForm($params));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();
            try {
                if (!$form->isValid()) {
                    throw new \Exception('Максимальный размер загружаемых изображений 2 МБ');
                }
                $newParams = $modelAdvert->setAdvertParams($formData);
                $advert = $modelAdvert->create($newParams, $this->getUser());

                $this->addFlash(
                    'success',
                    'Ваше объявление успешно создано'
                );
                return $this->redirect($this->generateUrl('advert', ['id' => $advert->getId()]));

            } catch (ValidationException $e) {
                $this->addFlash(
                    'warning',
                    'Произошла ошибка: ' . $e->getMessage()
                );
            } catch (\Exception $e) {
                $this->addFlash(
                    'warning',
                    'Произошла ошибка'
                );
            }
        }

        return $this->render('MrsuhRealEstateBundle:Advert:create_advert.html.twig', [
            'pageName' => 'Добавить объявление',
            'form' => $form->createView(),
            'regionsCity' => $modelAdvert->getAllRegionCity()
        ]);
    }

    public function findAdvertAction(Request $request)
    {
        $modelAdvert = $this->get('model.advert');

        $params = $modelAdvert->getAdvertParams();
        $form = $this->createForm(new FindAdvertForm($params));
        $pagination = [];
        $regions = [];
        if ($request->isMethod('POST')) {
            try{
                $form->handleRequest($request);
                $formData = $form->getData();
                $regions = $formData['object_region_city'];
                $pagination = $modelAdvert->findByParams($formData);

            } catch (\Exception $e) {
                $this->addFlash(
                    'warning',
                    'Произошла ошибка'
                );
            }
        }

        return $this->render('MrsuhRealEstateBundle:Advert:find_advert.html.twig', [
            'pageName' => 'Поиск объявления',
            'pagination' => $pagination,
            'form' => $form->createView(),
            'regionsCity' => $modelAdvert->getAllRegionCity(),
            'regions' => $regions
        ]);
    }

    public function findAdvertByClientAction(Request $request, $clientId)
    {
        $modelAdvert = $this->get('model.advert');
        $modelClient = $this->get('model.client');

        $params = $modelAdvert->getAdvertParams();
        $client = $modelClient->getOneById($clientId);
        $form = $this->createForm(new FindAdvertByClientForm($params, $client));
        $clientRegionsCity = $modelClient->getRegionCityByClientId($client->getId());
        $pagination = [];

        if ($request->isMethod('POST')) {
            try{
                $form->handleRequest($request);
                $formData = $form->getData();
                $pagination = $modelAdvert->findByParams($formData);
                $clientRegionsCity = array_keys($formData['object_region_city']);

            } catch (\Exception $e) {
                $this->addFlash(
                    'warning',
                    'Произошла ошибка'
                );
            }
        }

        return $this->render('MrsuhRealEstateBundle:Advert:find_advert_by_client.html.twig', [
            'pageName' => 'Поиск объявления по клиенту #' . $client->getId(),
            'pagination' => $pagination, 'form' => $form->createView(),
            'regionsCity' => $modelAdvert->getAllRegionCity(),
            'clientRegionsCity' => $clientRegionsCity,
            'client' => $client]);
    }

    public function changeUserAdvertListAction(Request $request)
    {
        $modelAdvert = $this->get('model.advert');

        $form = $this->createForm(new ChangeUserAdvertListForm());
        $params = ['change_user' => true, 'pagination_page' => 1, 'pagination_items_on_page' => 1000];
        $pagination = $modelAdvert->findByParams($params);

        if ($request->isMethod('POST')) {
            try{
                $form->handleRequest($request);
                $pagination = $modelAdvert->findByParams(array_merge($params, (array)$form->getData()));

            } catch (\Exception $e) {
                $this->addFlash(
                    'warning',
                    'Произошла ошибка'
                );
            }
        }

        return $this->render('MrsuhRealEstateBundle:Advert:change_user_list.html.twig', [
            'pageName' => 'Список объявлений для переноса пользователя',
            'pagination' => $pagination,
            'form' => $form->createView(),
        ]);
    }

    public function getAdvertByIdAction($id, Request $request)
    {
        $modelAdvert = $this->get('model.advert');

        $advert = $modelAdvert->getOneById($id);
        $params = $modelAdvert->getAdvertParams();
        $form = $this->createForm(new EditAdvertForm($params, $advert));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();
            try {
                if (!$form->isValid()) {
                    throw new \Exception('Максимальный размер загружаемых изображений 2 МБ');
                }
                $newParams = $this->get('model.advert')->setAdvertParams($formData);
                $modelAdvert->update($this->getUser(), $advert, $newParams);

                $this->addFlash(
                    'success',
                    'Данные успешно сохранены'
                );

            } catch (ValidationException $e) {
                $this->addFlash(
                    'warning',
                    'Произошла ошибка: ' . $e->getMessage()
                );
            } catch (\Exception $e) {
                $this->addFlash(
                    'warning',
                    'Произошла ошибка'
                );
            }
        }

        $self = ($this->getUser()->getId() === $advert->getUser()->getId() || CommonFunction::checkRoles($this->getUser()->getRole(), [C::ROLE_ADMIN])) ? true : false;

        return $this->render('MrsuhRealEstateBundle:Advert:advert.html.twig', [
            'pageName' => 'Объявление #' . $advert->getId(),
            'advert' => $advert,
            'form' => $form->createView(),
            'self' => $self,
            'regionsCity' => $modelAdvert->getAllRegionCity(),
        ]);
    }
}
