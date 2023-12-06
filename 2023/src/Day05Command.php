<?php

namespace AdventOfCode\TwentyTwentyThree;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'day05',
    description: 'Day 05: If You Give A Seed A Fertilizer'
)]
class Day05Command extends AbstractCommand
{

    protected function part1($input): int
    {
        list($seedLine, $seedToSoilMap, $soilToFertilizerMap, $fertilizerToWaterMap, $waterToLightMap,
            $lightToTemperatureMap, $temperatureToHumidityMap, $humidityToLocationMap) = explode("\n\n", $input);

        $conversions = [
            'seed' => 'soil',
            'soil' => 'fertilizer',
            'fertilizer' => 'water',
            'water' => 'light',
            'light' => 'temperature',
            'temperature' => 'humidity',
            'humidity' => 'location',
        ];

        $locations = [];
        $seeds = explode(' ', str_replace('seeds: ', '', $seedLine));
        foreach ($seeds as $seed) {
            foreach ($conversions as $from => $to) {
                $map = ${$from . 'To' . ucfirst($to) . 'Map'};
                $destination = $this->getDestination($map, $from === 'seed' ? $seed : $destination);
                if ($to === 'location') {
                    $locations[] = $destination;
                }
            }
        }

        return min($locations);
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

    private function getDestination(string $map, int $source): int
    {
        $lines = explode("\n", $map);
        for ($i = 1; $i < count($lines); $i++) {
            $line = $lines[$i];
            list($destinationStart, $sourceStart, $range) = array_map('intval', explode(' ', $line));
            if ($source >= $sourceStart && $source < $sourceStart + $range - 1) {
                return $destinationStart + $source - $sourceStart;
            }
        }
        return $source;
    }

}