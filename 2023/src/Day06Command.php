<?php

namespace AdventOfCode\TwentyTwentyThree;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'day06',
    description: 'Day 06: Wait For It'
)]
class Day06Command extends AbstractCommand
{

    protected function part1($input): int
    {
        $raceTimes = [];

        $raceTimesLines = $this->parseRaceTimesLines($input);
        for ($i = 0; $i < count($raceTimesLines[0]); $i++) {
            $raceTimes[] = [
                (int)$raceTimesLines[0][$i],
                (int)$raceTimesLines[1][$i],
            ];
        }

        $waysToWin = [];
        foreach ($raceTimes as $raceTime) {
            list($duration, $distance) = $raceTime;
            $minSpeedToWin = ceil(($duration - sqrt($duration * $duration - 4 * $distance)) / 2);
            $maxSpeedToWin = floor(($duration + sqrt($duration * $duration - 4 * $distance)) / 2);
            $waysToWin[] = intval($maxSpeedToWin - $minSpeedToWin + 1);
        }

        return array_product($waysToWin);
    }

    protected function part2($input): int
    {
        $raceTimesLines = $this->parseRaceTimesLines($input);
        $duration = (int)implode('', $raceTimesLines[0]);
        $distance = (int)implode('', $raceTimesLines[1]);
        $minSpeedToWin = ceil(($duration - sqrt($duration * $duration - 4 * $distance)) / 2);
        $maxSpeedToWin = floor(($duration + sqrt($duration * $duration - 4 * $distance)) / 2);
        return intval($maxSpeedToWin - $minSpeedToWin + 1);
    }

    private function parseRaceTimesLines($input): array
    {
        $lines = explode("\n", $input);
        foreach ($lines as $i => $line) {
            list ($label, $raceData) = explode(':', $line);
            $lines[$i] = array_values(array_filter(explode(' ', $raceData)));
        }
        return $lines;
    }

}