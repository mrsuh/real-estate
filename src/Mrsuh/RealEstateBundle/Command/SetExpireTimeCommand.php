<?php namespace Mrsuh\RealEstateBundle\Command;

use Mrsuh\RealEstateBundle\C;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SetExpireTimeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('advert:expire')
            ->setDescription('set expire time to advert');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        gc_disable();
        foreach (array('monolog.logger.doctrine', 'logger') as $service) {
            $logger = $this->getContainer()->get($service);
            $logger->pushHandler(new \Monolog\Handler\NullHandler());
        }

        $output->writeln('Set expire time to adverts...');

        $this->getContainer()->get('model.advert')->setExpireTime();

        $output->writeln('Done');
    }
} 