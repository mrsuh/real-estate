<?php namespace Mrsuh\RealEstateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Mrsuh\RealEstateBundle\C;

class ClientController extends Controller
{
    public function clientsAction(Request $request)
    {
        return $this->render('MrsuhRealEstateBundle:Client:clients.html.twig', ['pageName' => 'Клиенты']);
    }

    public function findClientAction(Request $request)
    {
        return $this->render('MrsuhRealEstateBundle:Client:find_client.html.twig', ['pageName' => 'Поиск клиента']);
    }

    public function createClientAction(Request $request)
    {
        return $this->render('MrsuhRealEstateBundle:Client:find_client.html.twig', ['pageName' => 'Занести клиента']);
    }

    public function clientAction(Request $request)
    {
        return $this->render('MrsuhRealEstateBundle:Client:client.html.twig', ['pageName' => 'Клиент']);
    }
}
