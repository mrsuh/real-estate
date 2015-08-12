<?php namespace Mrsuh\RealEstateBundle\Controller;

use Mrsuh\RealEstateBundle\Form\Client\CreateClientForm;
use Mrsuh\RealEstateBundle\Form\Client\EditClientForm;
use Mrsuh\RealEstateBundle\Form\Client\FindClientForm;
use Mrsuh\RealEstateBundle\Form\Client\ListClientForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends Controller
{
    public function findClientAction(Request $request)
    {
        $pagination = [];

        $form = $this->createForm(new FindClientForm(['user' => $this->get('model.user')->getUsersArray()]));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();

            $pagination = $this->get('model.client')->findByParams($formData);
        }

        return $this->render('MrsuhRealEstateBundle:Client:find_client.html.twig', ['pageName' => 'Поиск клиента', 'pagination' => $pagination, 'form' => $form->createView()]);
    }

    public function createClientAction(Request $request)
    {
        $params = $this->get('model.client')->getClientParams();
        $form = $this->createForm(new CreateClientForm($params));
        $regionsCity = $this->get('model.advert')->getAllRegionCity();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();
//            print_r($formData);exit;
            try {
                $newParams = $this->get('model.client')->setClientParams($formData);
                $user = $this->getUser();
                $client = $this->get('model.client')->create($newParams, $user);

                $this->addFlash(
                    'success',
                    'Клиент успешно создан'
                );
                return $this->redirect($this->generateUrl('client', ['id' => $client->getId()]));

            } catch (\Exception $e) {
                $this->addFlash(
                    'warning',
                    'Произошла ошибка: ' . $e->getMessage()
                );
            }
        }

        return $this->render('MrsuhRealEstateBundle:Client:create_client.html.twig', ['pageName' => 'Добавить клиента', 'form' => $form->createView(), 'regionsCity' => $regionsCity]);
    }

    public function getClientByIdAction($id, Request $request)
    {
        $client = $this->get('model.client')->getOneById($id);

        $params = $this->get('model.client')->getClientParams();
        $form = $this->createForm(new EditClientForm($client, $params));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();

            try {
                $newParams = $this->get('model.client')->setClientParams($formData);
                $this->get('model.client')->update($client, $newParams);

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

        return $this->render('MrsuhRealEstateBundle:Client:client.html.twig', ['pageName' => 'Клиент #' . $client->getId(), 'form' => $form->createView()]);
    }
}
