<?php namespace Mrsuh\RealEstateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Mrsuh\RealEstateBundle\C;

class DefaultController extends Controller
{
    public function defaultAction(Request $request)
    {
       $name =  $this->get('security.token_storage')->getToken()->getUser()->getUsername();

        return $this->render('MrsuhRealEstateBundle:Default:default.html.twig', ['name' => $name]);
    }
}
