<?php

namespace App\ManagerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
			->setName('import:addons')
			->setDescription('Import addons')
			->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
			->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the handler will yell in uppercase letters')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$gateway = $this->getContainer()->get('handler_gateway');
		$gateway->getHandler('Addon:Resource:WowAce', 'import', 'manager')->execute();
		$output->writeln('Deleted ');
	}
}

# 2 tasks , 1 update 1 recreate

# Why i need 2 tasks ?
	# because cron that only update is more silence and specific

# Task addon:import
	# get descriptions, files, images, last update etc