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

        return $this->render('MrsuhRealEstateBundle:Client:find_client.html.twig', [
            'pageName' => 'Поиск клиента',
            'pagination' => $pagination,
            'form' => $form->createView()
        ]);
    }

    public function createClientAction(Request $request)
    {
        $modelClient = $this->get('model.client');
        $params = $modelClient->getClientParams();
        $form = $this->createForm(new CreateClientForm($params));
        $regionsCity = $this->get('model.advert')->getAllRegionCity();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();
            try {
                $newParams = $modelClient->setClientParams($formData);
                $client = $modelClient->create($newParams, $this->getUser());

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

        return $this->render('MrsuhRealEstateBundle:Client:create_client.html.twig', [
            'pageName' => 'Добавить клиента',
            'form' => $form->createView(),
            'regionsCity' => $regionsCity
        ]);
    }

    public function getClientByIdAction($id, Request $request)
    {
        $modelClient = $this->get('model.client');
        $client = $modelClient->getOneById($id);
        $params = $modelClient->getClientParams();
        $form = $this->createForm(new EditClientForm($client, $params));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();
            try {
                $newParams = $modelClient->setClientParams($formData);
                $modelClient->update($client, $newParams);

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

        $form = $this->createForm(new EditClientForm($client, $params));
        $regionsCity = $this->get('model.advert')->getAllRegionCity();
        $clientRegionsCity = $modelClient->getRegionCityByClientId($client->getId());
        $reviewedAdverts = $modelClient->getReviewedAdvertsByClient($client);

        return $this->render('MrsuhRealEstateBundle:Client:client.html.twig', [
            'pageName' => 'Клиент #' . $client->getId(),
            'clientId' => $client->getId(),
            'form' => $form->createView(),
            'regionsCity' => $regionsCity,
            'clientRegionsCity' => $clientRegionsCity,
            'reviewedAdverts' => $reviewedAdverts
        ]);
    }
}
