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
        list($directions, $mapLines) = explode("\n\n", $input);

        $map = [];
        $startingPoints = [];
        $mapLines = explode("\n", $mapLines);
        foreach ($mapLines as $mapLine) {
            list($mapKey, $mapKeyValue) = explode(' = ', str_replace(['(', ',', ')'], '', $mapLine));
            list($left, $right) = explode(' ', $mapKeyValue);
            $map[$mapKey] = [$left, $right];
            if ($mapKey[2] === 'A') {
                $startingPoints[] = $mapKey;
            }
        }

        $routeLengths = [];
        foreach ($startingPoints as $startingPoint) {
            $i = 0;
            while ($startingPoint[2] !== 'Z') {
                $direction = $directions[$i % strlen($directions)];
                $startingPoint = $map[$startingPoint][$direction === 'L' ? 0 : 1];
                $i++;
            }
            $routeLengths[] = $i;
        }

        return $this->leastCommonMultiple($routeLengths);
    }

    private function leastCommonMultiple(array $routeLengths): int
    {
        $lcm = $routeLengths[0];
        for ($i = 1; $i < count($routeLengths); $i++) {
            $lcm = $lcm * $routeLengths[$i] / $this->greatestCommonDivisor($lcm, $routeLengths[$i]);
        }
    }

    private function greatestCommonDivisor($carry, $item): int
    {
        while ($item !== 0) {
            $t = $item;
            $item = $carry % $item;
            $carry = $t;
        }
        return $carry;
    }

}