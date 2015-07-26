<?php namespace Mrsuh\RealEstateBundle\Controller;

use Mrsuh\RealEstateBundle\Form\Profile\EditProfileForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{
    public function profileAction(Request $request)
    {
        $currentUser = $this->getUser();

        $params = [
            'username' => $currentUser->getUsername(),
            'first_name' => $currentUser->getFirstName(),
            'last_name' => $currentUser->getLastName(),
            'middle_name' => $currentUser->getMiddleName(),
            'phone' => $currentUser->getPhone(),
            'email' => $currentUser->getEmail(),
        ];

        $form = $this->createForm(new EditProfileForm($params));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();

            try{

                $this->get('model.profile')->update($currentUser, $formData);

                $this->addFlash(
                    'success',
                    'Ваши данные успешно сохранены'
                );
                $form = $this->createForm(new EditProfileForm($formData));

            } catch(\Exception $e){
                $this->addFlash(
                    'warning',
                    'Произошла ошибка ' . $e->getMessage()
                );
            }
        }

        return $this->render('MrsuhRealEstateBundle:Profile:profile.html.twig', ['pageName' => 'Профиль', 'form' => $form->createView()]);
    }
}
