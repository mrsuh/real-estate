<?php namespace Mrsuh\RealEstateBundle\Controller;

use Mrsuh\RealEstateBundle\Form\Advert\CreateAdvertForm;
use Mrsuh\RealEstateBundle\Form\Advert\FindAdvertForm;
use Mrsuh\RealEstateBundle\Form\Advert\EditAdvertForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Mrsuh\RealEstateBundle\C;

class AdvertController extends Controller
{
    public function createAdvertAction(Request $request)
    {
        $params = $this->get('model.advert')->getAdvertParams();
        $form = $this->createForm(new CreateAdvertForm($params));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();

            try{
                $newParams = $this->get('model.advert')->setAdvertParams($formData);
                $user = $this->getUser();
                $this->get('model.advert')->create($newParams, $user);

                $this->addFlash(
                    'success',
                    'Ваше объявленеи успешно создано'
                );
                $this->redirect($this->generateUrl('find_advert'));

            } catch(\Exception $e){
                $this->addFlash(
                    'warning',
                    'Произошла ошибка ' . $e->getMessage()
                );
            }
        }

        return $this->render('MrsuhRealEstateBundle:Advert:create_advert.html.twig', ['pageName' => 'Подать объявление', 'form' => $form->createView()]);
    }

    public function findAdvertAction(Request $request)
    {
        $params = $this->get('model.advert')->getAdvertParams();
        $form = $this->createForm(new FindAdvertForm($params));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();
        }


        return $this->render('MrsuhRealEstateBundle:Advert:find_advert.html.twig', ['pageName' => 'Поиск объявления', 'form' => $form->createView()]);
    }

    public function getAdvertByIdAction($id, Request $request)
    {
        $advert = $this->get('model.advert')->getOneById($id);

        $params = $this->get('model.advert')->getAdvertParams();
        $form = $this->createForm(new EditAdvertForm($params, $advert));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();
        }

        return $this->render('MrsuhRealEstateBundle:Advert:edit_advert.html.twig', ['pageName' => 'Объявление', 'advert' => $advert, 'form' => $form->createView()]);
    }
}
