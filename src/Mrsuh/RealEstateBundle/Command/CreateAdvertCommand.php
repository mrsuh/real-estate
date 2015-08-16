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



        for ($i = 0; $i < 100; $i++) {
            $output->writeln($i);
            $commonArea = rand(50, 100);
            $kitchenArea = rand(10, 30);
            $liveArea = $commonArea - $kitchenArea;
            $floor = rand(1, 18);
            $floors = rand($floor, 18);

            $object = [
                'object_type' => $em->getRepository(C::REPO_OBJECT_TYPE)->findOneById(1),
                'object_state' => $em->getRepository(C::REPO_OBJECT_STATE)->findOneById(1),
                'object_wall' => $em->getRepository(C::REPO_OBJECT_WALL)->findOneById(1),
                'object_room_number' => rand(1,5),
                'object_common_area' => $commonArea,
                'object_live_area' => $kitchenArea,
                'object_kitchen_area' => $liveArea,
                'object_section_area' => rand(50, 300),
                'object_floor' => $floor,
                'object_floors' => $floors,
                'object_build_year' => rand(1990, 2015),
                'object_water_supply' => $em->getRepository(C::REPO_OBJECT_WATER_SUPPLY)->findOneById(rand(1, 8)),
                'object_heating' => $em->getRepository(C::REPO_OBJECT_HEATING)->findOneById(rand(1, 11)),
                'object_new_house' => 1,
                'object_wc' => $em->getRepository(C::REPO_OBJECT_WC)->findOneById(rand(1, 2)),
                'object_balcony' => $em->getRepository(C::REPO_OBJECT_BALCONY)->findOneById(rand(1, 2)),
                'object_mortgage' => rand(0, 1),
                'object_region' => $em->getRepository(C::REPO_ADDRESS_REGION)->findOneById(rand(1, 11)),
                'object_city' => $em->getRepository(C::REPO_ADDRESS_CITY)->findOneById(1),
                'object_region_city' => $em->getRepository(C::REPO_ADDRESS_REGION_CITY)->findOneById(rand(1, 4)),
                'object_street' => $em->getRepository(C::REPO_ADDRESS_STREET)->findOneById(rand(1, 10)),
                'object_house' => rand(1, 50),
                'object_flat' => rand(1, 100),
                'object_landmark' => 'Путь'
            ];

            $price = rand(1500000, 3000000);
            $meterPrice = round($price/$commonArea);

            $advert = [
                'advert_user' => $em->getRepository(C::REPO_USER)->findOneById(rand(1, 3)),
                'advert_type' => $em->getRepository(C::REPO_ADVERT_TYPE)->findOneById(rand(1, 2)),
                'advert_exclusive' => rand(0, 1),
                'advert_seller_name1' => 'ФИО',
                'advert_seller_name2' => 'ФИО',
                'advert_seller_name3' => 'ФИО',
                'advert_seller_phone1' => 9999999999,
                'advert_seller_phone2' => 9999999999,
                'advert_seller_phone3' => 9999999999,
                'advert_price' => $price,
                'advert_meter_price' => $meterPrice,
                'advert_category' => $em->getRepository(C::REPO_ADVERT_CATEGORY)->findOneById(rand(1, 2)),
                'advert_status' => rand(1, 5)
            ];

            $description = [
                'description' => 'описание',
                'comment' => 'комментарий'
            ];

            $advert['advert_description'] = $em->getRepository(C::REPO_ADVERT_DESCRIPTION)->create($description);
            $advert['advert_object'] = $em->getRepository(C::REPO_OBJECT)->create($object);
            $em->getRepository(C::REPO_ADVERT)->create($advert);
        }

        $em->flush();


        $output->writeln('Done');
    }
} 