<?php namespace Mrsuh\RealEstateBundle\Controller;

use Mrsuh\RealEstateBundle\Form\Advert\CreateAdvertForm;
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


                $this->addFlash(
                    'success',
                    'Ваши данные успешно сохранены'
                );
                $form = $this->createForm(new CreateAdvertForm($params));

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
        return $this->render('MrsuhRealEstateBundle:Advert:find_advert.html.twig', ['pageName' => 'Поиск объявления']);
    }

    public function advertByIdAction(Request $request)
    {
        return $this->render('MrsuhRealEstateBundle:Advert:advert.html.twig', ['pageName' => 'Объявление']);
    }
}
