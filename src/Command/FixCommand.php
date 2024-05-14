<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;

class FixCommand extends Command
{
    protected static $defaultName = 'fix:maker';
    protected static $defaultDescription = 'Fix le maker-bundle';
    /**
     * @var string
     */
    private $projectDir;


    public function __construct(KernelInterface $kernel)
    {
        parent::__construct();
        $this->projectDir = $kernel->getProjectDir();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->copyr($this->projectDir."/templates-fix/", $this->projectDir."/vendor/symfony/maker-bundle/src/Resources/skeleton/");

        $io->success("Maker-bundle fixed");
        return Command::SUCCESS;
    }

    function copyr($source, $dest)
    {
        // if only one file
        if (is_file($source)) {
            return copy($source, $dest);
        }
        if (!is_dir($dest)) {
            mkdir($dest);
        }
        // Loop through the folder
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            // Deep copy directories
            if ($dest !== "$source/$entry") {
                $this->copyr("$source/$entry", "$dest/$entry");
            }
        }
        $dir->close();
        return true;
    }
}
