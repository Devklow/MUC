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

class UMLRelationMakerCommand extends Command
{
    protected static $defaultName = 'UML:make:relation';
    protected static $defaultDescription = 'Generate relations with puml diagram';

    /**
     * @param $string
     * @return string
     */
    public function getStrStartLower($string): string
    {
        $ret = strtolower(substr($string, 0, 1)) . substr($string, 1);
        return preg_replace("/[^a-zA-Z0-9]/", "", $ret);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'path to uml file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->writeln("=======================================");
        $file = $input->getArgument('file');
        $content = explode("\n",file_get_contents($file));
        $currentClass="";
        $targetClass="";
        $accessproperty = "no";
        $classList = [];
        foreach($content as $line){
            if(str_contains($line,"o--")){
                $exploded = explode(" ",$line);
                $currentClass = $exploded[0];
                $targetClass = $exploded[4];
                $currentClassNumber = explode("..",str_replace('"',"",$exploded[3]));
                $targetClassNumber = explode("..",str_replace('"',"",$exploded[1]));
                $fieldName = $this->getStrStartLower($targetClass);
                $nullable = "yes";
                $relation = "";

                if($currentClassNumber[0]=="1"){
                    $nullable = "no";
                }

                if($targetClassNumber[1]=="1"){
                    $relation = "OneTo";
                } else {
                    $relation = "ManyTo";
                }

                if($currentClassNumber[1]=="1"){
                    $relation .= "One";
                } else {
                    $relation .= "Many";
                    $fieldName.= 's';
                    if(!str_ends_with($fieldName,"s")){
                        $fieldName = substr_replace($this->getStrStartLower($targetClass),"s",-1);
                    }
                }

                if(str_contains($line,":")){
                    $pos = strpos($line, ":");
                    $fieldName = substr($line, $pos);
                    $fieldName = str_replace(" ","",$fieldName);
                    $fieldName = str_replace(":","",$fieldName);
                }
                $io->writeln("Création de la relation entre ".$currentClass." et ".$targetClass);
                $io->writeln("Relation : ".$relation);
                $io->writeln("Nom du champ : ".$fieldName);
                $options = $nullable."\n"."no"."\n"."\n";

                if(str_contains($relation,"OneToMany")){
                    $options = $this->getStrStartLower($currentClass)."\n".$nullable."\n\n\n";
                }
                if(str_contains($relation,"ManyToMany")){
                    $options = "no\n";
                }

                $input=$currentClass."\n".$fieldName."\n"."relation"."\n".$targetClass."\n";
                $input.=$relation."\n".$options;
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
                $io->writeln("Entité ".$currentClass." mise à jour");
                $io->writeln("=======================================");
            }
        }

        $io->success('Toutes les relations ont été crées');

        return Command::SUCCESS;
    }
}
