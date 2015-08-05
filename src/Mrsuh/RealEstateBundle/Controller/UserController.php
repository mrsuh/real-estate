<?php namespace Mrsuh\RealEstateBundle\Controller;

use Mrsuh\RealEstateBundle\Form\User\CreateUserForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Mrsuh\RealEstateBundle\C;

class UserController extends Controller
{
    public function getListUserAction(Request $request)
    {
        $users = $this->get('model.user')->getAll();
        return $this->render('MrsuhRealEstateBundle:User:list_user.html.twig', ['pageName' => 'Пользователи', 'users' => $users]);
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
        $form = $this->createForm(new CreateUserForm());

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();

            try{

                $this->get('model.user')->create($formData);

                $this->addFlash(
                    'success',
                    'Новый пользователь успешно создан'
                );

            } catch(\Exception $e){
                $this->addFlash(
                    'warning',
                    'Произошла ошибка ' . $e->getMessage()
                );
            }
        }

        return $this->render('MrsuhRealEstateBundle:User:create_user.html.twig', ['pageName' => 'Создать пользователя', 'form' => $form->createView()]);
    }
}
