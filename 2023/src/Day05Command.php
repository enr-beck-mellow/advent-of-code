<?php

namespace AdventOfCode\TwentyTwentyThree;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'day05',
    description: 'Day 05: ???'
)]
class Day05Command extends AbstractCommand
{

    protected function part1($input): int
    {
        $values = [];
        $lines = explode("\n", $input);
        foreach ($lines as $line) {
            $values[] = 0;
        }
        return array_sum($values);
    }

    protected function part2($input): int
    {
        $values = [];
        $lines = explode("\n", $input);
        foreach ($lines as $line) {
            $values[] = 0;
        }
        return array_sum($values);
    }
    
}