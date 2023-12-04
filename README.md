Advent of Code 2023
===================
This repository contains my solutions for [Advent of Code 2023](https://adventofcode.com/2023) written as a PHP CLI application with [symfony/console](https://symfony.com/doc/current/console.html).

## Installation
To install the dependencies, run the following command:
```bash
composer install
```

## Usage
To list all available days, use the following command:
```bash
./aoc
```

To run the code for a specific day, use the following command:
```bash
./aoc <day>
```

To run the code for a specific day and part, use the following command:
```bash
./aoc <day> <part>
```

You can supply the input for the code as a file:
```bash
./aoc -i <input-file> <day> <part>
```
If no input file is supplied, the input will be asked for in the terminal (confirm with ctrl-d).