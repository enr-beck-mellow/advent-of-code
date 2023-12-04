<?php

namespace AdventOfCode\TwentyTwentyThree;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'day02',
    description: 'Day 02: Cube Conundrum'
)]
class Day02Command extends AbstractCommand
{

    protected function part1($input): int
    {
        $possibleGames = [];
        $lines = explode("\n", $input);
        foreach ($lines as $line) {
            $possibleGames[] = $this->getGameNumberIfPossible($line);
        }
        return array_sum($possibleGames);
    }

    protected function part2($input): int
    {
        $possibleGames = [];
        $lines = explode("\n", $input);
        foreach ($lines as $line) {
            $possibleGames[] = $this->getLowestPossibleSetPower($line);
        }
        return array_sum($possibleGames);
    }

    private function getGameNumberIfPossible(string $line): int
    {
        $possible = true;
        $maxCubes = [
            'red' => 12,
            'green' => 13,
            'blue' => 14,
        ];

        list($gameName, $gameTurns) = explode(': ', $line);
        $gameNo = intval(str_replace('Game ', '', $gameName));

        $turns = explode('; ', $gameTurns);
        foreach ($turns as $turn) {
            $rolls = explode(', ', $turn);
            foreach ($rolls as $roll) {
                list($number, $color) = explode(' ', $roll);
                if ($maxCubes[$color] < $number) {
                    $possible = false;
                }
            }
        }

        return $possible ? $gameNo : 0;
    }

    private function getLowestPossibleSetPower(string $line): int
    {
        $power = [
            'red' => 0,
            'green' => 0,
            'blue' => 0,
        ];

        list($gameName, $gameTurns) = explode(': ', $line);
        $turns = explode('; ', $gameTurns);
        foreach ($turns as $turn) {
            $rolls = explode(', ', $turn);
            foreach ($rolls as $roll) {
                list($number, $color) = explode(' ', $roll);
                if ($power[$color] < intval($number)) {
                    $power[$color] = intval($number);
                }
            }
        }

        return $power['red'] * $power['green'] * $power['blue'];
    }

}