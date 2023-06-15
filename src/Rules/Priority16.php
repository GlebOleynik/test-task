<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Rules;

use Goleynik\WordsDeclension\Refference\Gender;
use Goleynik\WordsDeclension\Refference\LanguageCases;
use Goleynik\WordsDeclension\Refference\WordType;
use Goleynik\WordsDeclension\Word;

class Priority16 extends AbstractRule
{
    public const ENDING_REPLACE = [
        LanguageCases::NOMINATIVE->name => null,
        LanguageCases::GENITIVE->name => 'ой',
        LanguageCases::ACCUSATIVE->name => 'ой',
        LanguageCases::DATIVE->name => 'ую',
        LanguageCases::INSTRUMENTAL->name => 'ой',
        LanguageCases::PREPOSITIONAL->name => 'ой',
    ];

    private const ENDINGS = [
        'ая',
    ];

    public function __construct(Word $word)
    {
        parent::__construct($word, self::ENDINGS);
    }

    public function isSupport(): bool
    {
        $genderCompatible = Gender::FEMALE === $this->word->gender;
        $wordTypeCompatible = WordType::SURNAME === $this->word->wordType;

        return
            $genderCompatible
            && $wordTypeCompatible
            && $this->isEndingMatches();
    }
}
