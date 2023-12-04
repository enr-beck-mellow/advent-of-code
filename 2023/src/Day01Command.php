<?php

namespace AdventOfCode\TwentyTwentyThree;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'day01',
    description: 'Day 01: Trebuchet?!'
)]
class Day01Command extends AbstractCommand
{
    const NUMBER_WORDS = [
        'one' => '1',
        'two' => '2',
        'three' => '3',
        'four' => '4',
        'five' => '5',
        'six' => '6',
        'seven' => '7',
        'eight' => '8',
        'nine' => '9'
    ];

    protected function part1($input): int
    {
        $sum = 0;
        $lines = explode("\n", $input);
        foreach ($lines as $line) {
            $first = $this->findFirstNumber($line);
            $last = $this->findFirstNumber($line, true);
            $sum += intval($first.$last);
        }
        return $sum;
    }

    protected function part2($input): int
    {
        $sum = 0;
        $lines = explode("\n", $input);
        foreach ($lines as $line) {
            $first = $this->findFirstNumber($line, false, true);
            $last = $this->findFirstNumber($line, true, true);
            $sum += intval($first.$last);
        }
        return $sum;
    }

    private function findFirstNumber($line, $reverse = false, $checkNumberWords = false)
    {
        $line = $reverse ? strrev($line) : $line;

        $firstDigitPos = strcspn($line, '1234567890');
        $firstDigit = $line[$firstDigitPos];

        if (!$checkNumberWords) {
            return $firstDigit;
        }

        $firstNumberWordPos = strlen($line);
        $firstNumberWord = '';

        foreach (self::NUMBER_WORDS as $word => $number) {
            $word = $reverse ? strrev($word) : $word;
            $pos = strpos($line, $word);
            if ($pos !== false && $pos < $firstNumberWordPos) {
                $firstNumberWord = $number;
                $firstNumberWordPos = $pos;
            }
        }

        return $firstDigitPos < $firstNumberWordPos ? $firstDigit : $firstNumberWord;
    }

}