<?php namespace Mrsuh\RealEstateBundle\Controller;

use Mrsuh\RealEstateBundle\Form\Client\CreateClientForm;
use Mrsuh\RealEstateBundle\Form\Client\EditClientForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends Controller
{
    public function getListClientAction(Request $request)
    {
        $clients = $this->get('model.client')->findByParam();

        return $this->render('MrsuhRealEstateBundle:Client:list_client.html.twig', ['pageName' => 'Клиенты', 'clients' => $clients]);
    }

    public function findClientAction(Request $request)
    {
        return $this->render('MrsuhRealEstateBundle:Client:find_client.html.twig', ['pageName' => 'Поиск клиента']);
    }

    public function createClientAction(Request $request)
    {
        $params = $this->get('model.client')->getClientParams();
        $form = $this->createForm(new CreateClientForm($params));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();

            try{
                $newParams = $this->get('model.client')->setClientParams($formData);
                $user = $this->getUser();
                $this->get('model.client')->create($newParams, $user);

                $this->addFlash(
                    'success',
                    'Клиент успешно создан'
                );

            } catch(\Exception $e){
                $this->addFlash(
                    'warning',
                    'Произошла ошибка ' . $e->getMessage()
                );
            }
        }

        return $this->render('MrsuhRealEstateBundle:Client:create_client.html.twig', ['pageName' => 'Занести клиента', 'form' => $form->createView()]);
    }

    public function getClientByIdAction($id, Request $request)
    {
        $client = $this->get('model.client')->getOneById($id);

        $params = $this->get('model.client')->getClientParams();
        $form = $this->createForm(new EditClientForm($client, $params));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();
        }

        return $this->render('MrsuhRealEstateBundle:Client:client.html.twig', ['pageName' => 'Клиент #' . $client->getId(), 'form' => $form->createView()]);
    }
}
