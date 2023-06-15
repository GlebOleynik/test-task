<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Rules;

use Goleynik\WordsDeclension\Refference\Gender;
use Goleynik\WordsDeclension\Refference\LanguageCases;
use Goleynik\WordsDeclension\Refference\WordType;
use Goleynik\WordsDeclension\Word;

class Priority9 extends AbstractRule
{
    public const ENDING_REPLACE = [
        LanguageCases::NOMINATIVE->name => null,
        LanguageCases::GENITIVE->name => 'ого',
        LanguageCases::ACCUSATIVE->name => 'ому',
        LanguageCases::DATIVE->name => 'ого',
        LanguageCases::INSTRUMENTAL->name => 'им',
        LanguageCases::PREPOSITIONAL->name => 'ом',
    ];

    private const ENDINGS = [
        'ий',
        'ой',
    ];

    public function __construct(Word $word)
    {
        parent::__construct($word, self::ENDINGS);
    }

    public function isSupport(): bool
    {
        $genderCompatible = Gender::MALE === $this->word->gender;
        $wordTypeCompatible = WordType::SURNAME === $this->word->wordType;

        return
            $genderCompatible
            && $wordTypeCompatible
            && $this->isEndingMatches();
    }
}
