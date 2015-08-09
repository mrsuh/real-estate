<?php namespace Mrsuh\RealEstateBundle\Controller;

use Mrsuh\RealEstateBundle\Form\Advert\CreateAdvertForm;
use Mrsuh\RealEstateBundle\Form\Advert\FindAdvertForm;
use Mrsuh\RealEstateBundle\Form\Advert\EditAdvertForm;
use Mrsuh\RealEstateBundle\Service\CommonFunction;
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
                $advert = $this->get('model.advert')->create($newParams, $user);

                $this->addFlash(
                    'success',
                    'Ваше объявление успешно создано'
                );
                return $this->redirect($this->generateUrl('advert', ['id' => $advert->getId()]));

            } catch(\Exception $e){
                $this->addFlash(
                    'warning',
                    'Произошла ошибка: ' . $e->getMessage()
                );
            }
        }

        return $this->render('MrsuhRealEstateBundle:Advert:create_advert.html.twig', ['pageName' => 'Подать объявление', 'form' => $form->createView()]);
    }

    public function findAdvertAction(Request $request)
    {
        $params = $this->get('model.advert')->getAdvertParams();
        $form = $this->createForm(new FindAdvertForm($params));
        $pagination = [];

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);
            $formData = $form->getData();
            switch($formData['search_type']){
                case C::SEARCH_STRING:
                    $pagination = $this->get('model.advert')->findByString($formData);
                    break;
                case C::SEARCH_EXTENSION:
                    $pagination = $this->get('model.advert')->findByExtensionParams($formData);
            }
        }

        return $this->render('MrsuhRealEstateBundle:Advert:find_advert.html.twig', ['pageName' => 'Поиск объявления', 'pagination' => $pagination, 'form' => $form->createView()]);
    }

    public function getListAdvertAction(Request $request)
    {
        $adverts = $this->get('model.advert')->findByParam();
        return $this->render('MrsuhRealEstateBundle:Advert:list_advert.html.twig', ['pageName' => 'Список объявлений', 'adverts' => $adverts]);
    }

    public function getAdvertByIdAction($id, Request $request)
    {
        $advert = $this->get('model.advert')->getOneById($id);

        $params = $this->get('model.advert')->getAdvertParams();
        $form = $this->createForm(new EditAdvertForm($params, $advert));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $formData = $form->getData();

            try{
                $newParams = $this->get('model.advert')->setAdvertParams($formData);
                $this->get('model.advert')->update($advert, $newParams);

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

        return $this->render('MrsuhRealEstateBundle:Advert:advert.html.twig', ['pageName' => 'Объявление #' . $advert->getId(), 'advert' => $advert, 'form' => $form->createView()]);
    }

    public function toArchiveAdvertAction(Request $request)
    {
        $adverts = $this->get('model.advert')->findToArchive();
        return $this->render('MrsuhRealEstateBundle:Advert:list_advert.html.twig', ['pageName' => 'Список объявлений в архив', 'adverts' => $adverts]);
    }
}
