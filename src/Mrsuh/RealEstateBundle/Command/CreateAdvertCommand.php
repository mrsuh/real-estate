<?php namespace Mrsuh\RealEstateBundle\Command;

use Mrsuh\RealEstateBundle\C;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateAdvertCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('advert:create')
            ->setDescription('create adverts');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        gc_disable();
        foreach (array('monolog.logger.doctrine', 'logger') as $service) {
            $logger = $this->getContainer()->get($service);
            $logger->pushHandler(new \Monolog\Handler\NullHandler());
        }

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $object = [
            'object_type' => $em->getRepository(C::REPO_OBJECT_TYPE)->findOneById(1),
            'object_state' => $em->getRepository(C::REPO_OBJECT_STATE)->findOneById(1),
            'object_wall' => $em->getRepository(C::REPO_OBJECT_WALL)->findOneById(1),
            'object_room_number' => 4,
            'object_common_area' => 70,
            'object_live_area' => 50,
            'object_kitchen_area' => 20,
            'object_section_area' => 300,
            'object_floor' => 4,
            'object_floors' => 16,
            'object_build_year' => 2000,
            'object_water_supply' => $em->getRepository(C::REPO_OBJECT_WATER_SUPPLY)->findOneById(1),
            'object_heating' => $em->getRepository(C::REPO_OBJECT_HEATING)->findOneById(1),
            'object_new_house' => 1,
            'object_wc' => $em->getRepository(C::REPO_OBJECT_WC)->findOneById(1),
            'object_balcony' => $em->getRepository(C::REPO_OBJECT_BALCONY)->findOneById(1),
            'object_mortgage' => 1,
            'object_region' => $em->getRepository(C::REPO_ADDRESS_REGION)->findOneById(1),
            'object_city' => $em->getRepository(C::REPO_ADDRESS_CITY)->findOneById(1),
            'object_region_city' => $em->getRepository(C::REPO_ADDRESS_REGION_CITY)->findOneById(1),
            'object_street' => $em->getRepository(C::REPO_ADDRESS_STREET)->findOneById(1),
            'object_house' => 1,
            'object_flat' => 40,
            'object_landmark' => 'Путь'
        ];

        $advert = [
            'advert_user' => $em->getRepository(C::REPO_USER)->findOneById(1),
            'advert_type' => $em->getRepository(C::REPO_ADVERT_TYPE)->findOneById(1),
            'advert_exclusive' => 1,
            'advert_seller_name1' => 'ФИО',
            'advert_seller_name2' => 'ФИО',
            'advert_seller_name3' => 'ФИО',
            'advert_seller_phone1' => 9999999999,
            'advert_seller_phone2' => 9999999999,
            'advert_seller_phone3' => 9999999999,
            'advert_price' => 3000000,
            'advert_meter_price' => 30000,
            'advert_category' => $em->getRepository(C::REPO_ADVERT_CATEGORY)->findOneById(1)
        ];

        $description = [
            'description' => 'описание',
            'comment' => 'комментарий'
        ];


        for ($i = 0; $i < 500; $i++) {
            $output->writeln($i);
            $advert['advert_description'] = $em->getRepository(C::REPO_ADVERT_DESCRIPTION)->create($description);
            $advert['advert_object'] = $em->getRepository(C::REPO_OBJECT)->create($object);
            $em->getRepository(C::REPO_ADVERT)->create($advert);

            if($i%200 === 0) {
                $output->writeln('flush');
                $em->flush();
            }
        }

        $em->flush();


        $output->writeln('Done');
    }
} 