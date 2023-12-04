<?php

namespace AdventOfCode\TwentyTwentyThree;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'day03',
    description: 'Day 03: Gear Ratios'
)]
class Day03Command extends AbstractCommand
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