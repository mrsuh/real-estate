<?php namespace Mrsuh\RealEstateBundle\Controller;

use Mrsuh\RealEstateBundle\Form\User\CreateUserForm;
use Mrsuh\RealEstateBundle\Form\User\EditUserForm;
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

    public function userAction($id, Request $request)
    {
        $user = $this->get('model.user')->getUserById($id);
        $form = $this->createForm(new EditUserForm($user));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();
            try{
                $user = $this->get('model.user')->update($user, $formData);

                $this->addFlash(
                    'success',
                    'Данные успешно сохранены'
                );

                $form = $this->createForm(new EditUserForm($user));
            } catch(\Exception $e){
                $this->addFlash(
                    'warning',
                    'Произошла ошибка: ' . $e->getMessage()
                );
            }
        }

        return $this->render('MrsuhRealEstateBundle:User:user.html.twig', ['pageName' => 'Пользователь ' . $user->getUsername(), 'form' => $form->createView()]);
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
                    'Новый пользователь успешно создан. Логин и пароль высланы по адресу ' . $formData['email']
                );


            } catch(\Exception $e){
                $this->addFlash(
                    'warning',
                    'Произошла ошибка: ' . $e->getMessage()
                );
            }
        }

        return $this->render('MrsuhRealEstateBundle:User:create_user.html.twig', ['pageName' => 'Создать пользователя', 'form' => $form->createView()]);
    }

    public function profileAction(Request $request)
    {
        $currentUser = $this->getUser();
        $form = $this->createForm(new EditUserForm($currentUser));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();

            try{

                $this->get('model.user')->update($currentUser, $formData);

                $this->addFlash(
                    'success',
                    'Данные успешно сохранены'
                );

            } catch(\Exception $e){
                $this->addFlash(
                    'warning',
                    'Произошла ошибка: ' . $e->getMessage()
                );
            }
        }

        return $this->render('MrsuhRealEstateBundle:User:user.html.twig', ['pageName' => 'Профиль', 'form' => $form->createView()]);
    }
}
