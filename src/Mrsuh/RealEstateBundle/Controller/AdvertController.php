<?php namespace Mrsuh\RealEstateBundle\Controller;

use Mrsuh\RealEstateBundle\Form\Advert\ChangeUserAdvertListForm;
use Mrsuh\RealEstateBundle\Form\Advert\CreateAdvertForm;
use Mrsuh\RealEstateBundle\Form\Advert\FindAdvertByClientForm;
use Mrsuh\RealEstateBundle\Form\Advert\FindAdvertForm;
use Mrsuh\RealEstateBundle\Form\Advert\EditAdvertForm;
use Mrsuh\RealEstateBundle\Service\CommonFunction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Mrsuh\RealEstateBundle\C;

class AdvertController extends Controller
{
    public function createAdvertAction(Request $request)
    {
        $params = $this->get('model.advert')->getAdvertParams();
        $form = $this->createForm(new CreateAdvertForm($params));
        $regionsCity = $this->get('model.advert')->getAllRegionCity();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();
            try {
                if(!$form->isValid()){
                    throw new \Exception('Максимальный размер загружаемых изображений 2 МБ');
                }
                $newParams = $this->get('model.advert')->setAdvertParams($formData);
                $user = $this->getUser();
                $advert = $this->get('model.advert')->create($newParams, $user);

                $this->addFlash(
                    'success',
                    'Ваше объявление успешно создано'
                );
                return $this->redirect($this->generateUrl('advert', ['id' => $advert->getId()]));

            } catch (\Exception $e) {
                $this->addFlash(
                    'warning',
                    'Произошла ошибка: ' . $e->getMessage()
                );
            }
        }

        return $this->render('MrsuhRealEstateBundle:Advert:create_advert.html.twig', [
            'pageName' => 'Добавить объявление',
            'form' => $form->createView(),
            'regionsCity' => $regionsCity
        ]);
    }

    public function findAdvertAction(Request $request)
    {
        $params = $this->get('model.advert')->getAdvertParams();
        $form = $this->createForm(new FindAdvertForm($params));
        $regionsCity = $this->get('model.advert')->getAllRegionCity();
        $pagination = [];

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $pagination = $this->get('model.advert')->findByParams($form->getData());
        }

        return $this->render('MrsuhRealEstateBundle:Advert:find_advert.html.twig', [
            'pageName' => 'Поиск объявления',
            'pagination' => $pagination,
            'form' => $form->createView(),
            'regionsCity' => $regionsCity
        ]);
    }

    public function findAdvertByClientAction(Request $request, $clientId)
    {
        $params = $this->get('model.advert')->getAdvertParams();
        $client = $this->get('model.client')->getOneById($clientId);
        $form = $this->createForm(new FindAdvertByClientForm($params, $client));
        $regionsCity = $this->get('model.advert')->getAllRegionCity();
        $clientRegionsCity = $this->get('model.client')->getRegionCityByClientId($client->getId());
        $pagination = [];

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $pagination = $this->get('model.advert')->findByExtensionParams($form->getData());
        }

        return $this->render('MrsuhRealEstateBundle:Advert:find_advert_by_client.html.twig', [
            'pageName' => 'Поиск объявления по клиенту #' . $client->getId(),
            'pagination' => $pagination, 'form' => $form->createView(),
            'regionsCity' => $regionsCity,
            'clientRegionsCity' => $clientRegionsCity,
            'client' => $client]);
    }

    public function changeUserAdvertListAction(Request $request)
    {

        $form = $this->createForm(new ChangeUserAdvertListForm());
        $params = ['change_user' => true, 'pagination_page' =>1, 'pagination_items_on_page' => 1000 ];
        $pagination = $this->get('model.advert')->findByParams($params);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $pagination = $this->get('model.advert')->findByParams(array_merge($params, (array)$form->getData()));
        }

        return $this->render('MrsuhRealEstateBundle:Advert:change_user_list.html.twig', [
            'pageName' => 'Список объявлений для переноса пользователя',
            'pagination' => $pagination,
            'form' => $form->createView(),
        ]);
    }

    public function getAdvertByIdAction($id, Request $request)
    {
        $advert = $this->get('model.advert')->getOneById($id);
        $params = $this->get('model.advert')->getAdvertParams();
        $form = $this->createForm(new EditAdvertForm($params, $advert));
        $regionsCity = $this->get('model.advert')->getAllRegionCity();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();
            try {
                if(!$form->isValid()){
                    throw new \Exception('Максимальный размер загружаемых изображений 2 МБ');
                }
                $newParams = $this->get('model.advert')->setAdvertParams($formData);
                $this->get('model.advert')->update($this->getUser(), $advert, $newParams);

                $this->addFlash(
                    'success',
                    'Данные успешно сохранены'
                );

            } catch (\Exception $e) {
                $this->addFlash(
                    'warning',
                    'Произошла ошибка: ' . $e->getMessage()
                );
            }
        }

        if($this->getUser()->getId() === $advert->getUser()->getId() || CommonFunction::checkRoles($this->getUser()->getRole(), [C::ROLE_ADMIN])) {
            $self = true;
        } else {
            $self = false;
        }

        return $this->render('MrsuhRealEstateBundle:Advert:advert.html.twig', [
            'pageName' => 'Объявление #' . $advert->getId(),
            'advert' => $advert,
            'form' => $form->createView(),
            'self' => $self,
            'regionsCity' => $regionsCity
        ]);
    }
}
