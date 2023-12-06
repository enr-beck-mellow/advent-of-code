<?php

namespace AdventOfCode\TwentyTwentyThree;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'day04',
    description: 'Day 04: Scratchcards'
)]
class Day04Command extends AbstractCommand
{

    protected function part1($input): int
    {
        $values = [];
        $lines = explode("\n", $input);
        foreach ($lines as $line) {
            $values[] = $this->getCardValue($line);
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

    private function getCardValue(string $line): int
    {
        list($card, $numbers) = explode(': ', $line);
        list($winningNumbers, $cardNumbers) = explode(' | ', $numbers);

        $winningNumbers = array_filter(array_map('intval', explode(' ', $winningNumbers)));
        $cardNumbers = array_filter(array_map('intval', explode(' ', $cardNumbers)));

        $value = 0;
        foreach ($winningNumbers as $winningNumber) {
            if (in_array($winningNumber, $cardNumbers)) {
                $value++;
            }
        }

        return $value ? pow(2, $value - 1) : 0;
    }

}