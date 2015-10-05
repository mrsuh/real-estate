<?php namespace Mrsuh\RealEstateBundle\Command;

use Mrsuh\RealEstateBundle\C;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateDBDumpCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('database:dump')
            ->setDescription('Create db dump');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        gc_disable();
        foreach (array('monolog.logger.doctrine', 'logger') as $service) {
            $logger = $this->getContainer()->get($service);
            $logger->pushHandler(new \Monolog\Handler\NullHandler());
        }

        $output->writeln('Create database dump');
        $this->getContainer()->get('model.security')->createDbDump();
        $output->writeln('Done');
    }
} 