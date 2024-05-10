<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class UMLEntityMakerCommand extends Command
{
    protected static $defaultName = 'UML:make:entities';
    protected static $defaultDescription = 'Generate Entity with puml diagram';

    protected function configure(): void
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'path to uml file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $file = $input->getArgument('file');
        $content = explode("\n",file_get_contents($file));
        $currentClass="";
        $classList = [];
        $openedBracket = 0;
        foreach($content as $line){
            if(str_contains($line,"{")){
                $openedBracket++;
            }

            if(str_contains($line,"class")){
                $currentClass = explode(" ",$line)[1];
                $currentClass = str_replace("{","",$currentClass);
            }
            else if(str_contains($line,"-") && str_contains($line,":") && $openedBracket>=1){
                $field = explode(":",$line)[0];
                $field = str_replace("-","",$field);
                $field = str_replace(" ","",$field);
                $type = str_replace(" ","",explode(":",$line)[1]);
                $classList[$currentClass][$field] = $type;
            }

            if(str_contains($line,"}")){
                $openedBracket--;
            }
        }
        foreach ($classList as $class=>$fields){
            $io->writeln("Création de l'entité ".$class."...");
            foreach ($fields as $field=>$type) {
                $io->writeln("Création du champ ".$field." de type ".$type);
                $options = "no\n"."\n";
                if(str_contains($type,"string")) {
                    $options = "255\n" . "no\n" . "\n";
                }
                $input=$class."\n".$field."\n".$type."\n".$options;
                $process = new Process(['php', 'bin/console', "make:entity"],
                    null,
                    null,
                    $input."\n");
                $process->enableOutput();
                $process->setPty(true);
                $process->run();
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }
                }
            $io->writeln("Entité ".$class." crée");
        }

        $io->success('Toutes les entités ont été crées');

        return Command::SUCCESS;
    }
}
