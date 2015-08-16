<?php namespace Mrsuh\RealEstateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function redirectAction()
    {
        return $this->redirect($this->generateUrl('login'));
    }

    public function sidebarAction($path)
    {
        $name = $this->get('security.token_storage')->getToken()->getUser()->getUsername();
        return $this->render('MrsuhRealEstateBundle:Default:sidebar.html.twig', [
            'username' => $name,
            'path' => $path
        ]);
    }
}
