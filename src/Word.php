<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension;

use Goleynik\WordsDeclension\Refference\Gender;
use Goleynik\WordsDeclension\Refference\WordType;

final readonly class Word
{
    public function __construct(
        public Gender $gender,
        public WordType $wordType,
        public string $word,
    ) {
    }
}
