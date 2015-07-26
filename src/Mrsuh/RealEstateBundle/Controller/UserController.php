<?php namespace Mrsuh\RealEstateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Mrsuh\RealEstateBundle\C;

class UserController extends Controller
{
    public function usersAction(Request $request)
    {
        return $this->render('MrsuhRealEstateBundle:User:users.html.twig', ['pageName' => 'Пользователи']);
    }

    public function userAction(Request $request)
    {
        return $this->render('MrsuhRealEstateBundle:User:user.html.twig', ['pageName' => 'Пользователь']);
    }

    public function finsUserAction(Request $request)
    {
        return $this->render('MrsuhRealEstateBundle:User:find_user.html.twig', ['pageName' => 'Поиск пользователей']);
    }

    public function createUserAction(Request $request)
    {
        return $this->render('MrsuhRealEstateBundle:User:create_user.html.twig', ['pageName' => 'Создать пользователя']);
    }
}
