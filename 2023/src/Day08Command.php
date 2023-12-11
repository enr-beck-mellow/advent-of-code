<?php

namespace AdventOfCode\TwentyTwentyThree;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'day08',
    description: 'Day 08: Haunted Wasteland'
)]
class Day08Command extends AbstractCommand
{

    protected function part1($input): int
    {
        list($directions, $mapLines) = explode("\n\n", $input);

        $map = [];
        $mapLines = explode("\n", $mapLines);
        foreach ($mapLines as $mapLine) {
            list($mapKey, $mapKeyValue) = explode(' = ', str_replace(['(', ',', ')'], '', $mapLine));
            list($left, $right) = explode(' ', $mapKeyValue);
            $map[$mapKey] = [$left, $right];
        }

        $i = 0;
        $next = 'AAA';
        while ($next !== 'ZZZ') {
            $direction = $directions[$i % strlen($directions)];
            $next = $map[$next][$direction === 'L' ? 0 : 1];
            $i++;
        }

        return $i;
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