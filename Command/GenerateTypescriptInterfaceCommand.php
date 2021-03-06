<?php

namespace Targus\ObjectFetcher\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Targus\ObjectFetcher\Objects\ObjectFetcherService;

class GenerateTypescriptInterfaceCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('generate:typescript:interface')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::REQUIRED, 'Argument description')
            ->addOption('to', null, InputOption::VALUE_OPTIONAL, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argument = $input->getArgument('argument');

//        if ($input->getOption('option')) {
            // ...
//        }

        $fetcher =  $this->getContainer()->get('targus.object_fetcher.service');
        switch (strtolower($input->getOption('to'))) {
            case 'js':
                $text = $fetcher->createJsClass($argument)['text'];
                break;
            default:
                $text = $fetcher->createInterface($argument)['text'];
        }

        $output->writeln($text);
    }

}
