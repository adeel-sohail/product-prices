<?php

namespace App\Command;

use App\Service\MockApiService;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:save-product-prices',
    description: 'Saves product prices automatically.',
)]
class SaveProductPricesCommand extends Command
{
    public function __construct(private readonly MockApiService $mockApiService, private readonly LoggerInterface $logger)
    {
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->mockApiService->saveProductPrices();
            $this->logger->info('saving product prices at: ' . date('Y-m-d H:i:s'));
            $output->writeln('<info>Products saved successfully!</info>');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $output->writeln('<error>Error: ' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }
    }
}
