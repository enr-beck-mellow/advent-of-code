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
        $directions = str_replace(['L', 'R'], ['0', '1'], $directions);

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
            $direction = (int)$directions[$i % strlen($directions)];
            $next = $map[$next][$direction];
            $i++;
        }

        return $i;
    }

    protected function part2($input): int
    {
        list($directions, $mapLines) = explode("\n\n", $input);
        $directions = str_replace(['L', 'R'], ['0', '1'], $directions);

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
                $direction = (int)$directions[$i % strlen($directions)];
                $startingPoint = $map[$startingPoint][$direction];
                $i++;
            }
            $routeLengths[] = $i;
        }

        return $this->leastCommonMultiple($routeLengths);
    }

    private function leastCommonMultiple(array $numbers): int
    {
        // https://en.wikipedia.org/wiki/Least_common_multiple
        return array_reduce(
            $numbers,
            fn($carry, $number) => $carry * $number / $this->greatestCommonDivisor($carry, $number),
            1
        );
    }

    private function greatestCommonDivisor($a, $b): int
    {
        // https://en.wikipedia.org/wiki/Euclidean_algorithm
        return $b === 0 ? $a : $this->greatestCommonDivisor($b, $a % $b);
    }

}