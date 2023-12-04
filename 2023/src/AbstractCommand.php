<?php

namespace AdventOfCode\TwentyTwentyThree;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

abstract class AbstractCommand extends Command
{
    public function configure(): void
    {
        $this->addArgument('part', InputArgument::OPTIONAL, 'Part of the day to run (1 or 2)');
        $this->addOption('input', 'i', InputOption::VALUE_OPTIONAL, 'Input file');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        // get input data
        $inputFile = $input->getOption('input');
        if ($inputFile) {
            $inputData = file_get_contents($inputFile);
        } else {
            $questionHelper = $this->getHelper('question');
            $question = new Question('Enter puzzle input: ');
            $question->setMultiline(true);
            $inputData = $questionHelper->ask($input, $output, $question);
            $output->writeln('');
        }

        // run part 1, part 2, or both
        $part = $input->getArgument('part');
        if ($part === '1') {
            $output->writeln("Part 1: " . $this->part1($inputData));
        } elseif ($part === '2') {
            $output->writeln("Part 2: " . $this->part2($inputData));
        } else {
            $output->writeln("Part 1: " . $this->part1($inputData));
            $output->writeln("Part 2: " . $this->part2($inputData));
        }

        return Command::SUCCESS;
    }

    abstract protected function part1($input);
    abstract protected function part2($input);
}