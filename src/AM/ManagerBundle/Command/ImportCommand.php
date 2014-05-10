<?php

namespace AM\ManagerBundle\Command;

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
			->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$gateway = $this->getContainer()->get('task_gateway');
		$gateway->getTask('addon', 'delete', 'manager')->setData(4)->execute();

		$output->writeln('Deleted ');
	}
}

// JSON files contain all categories
// Loop trough all categories for each addon do the following:

# Check if the addon exists
	# If exists check if its updated
		# Updated addon
		# Ignore and continue
	# If not exists create new record in addons and add it
