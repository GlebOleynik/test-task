<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Rules;

use Goleynik\WordsDeclension\Refference\Gender;
use Goleynik\WordsDeclension\Refference\LanguageCases;
use Goleynik\WordsDeclension\Refference\Letters;
use Goleynik\WordsDeclension\Refference\WordType;
use Goleynik\WordsDeclension\Word;

class Priority2 extends AbstractRule
{
    public const ENDING_REPLACE = [
        LanguageCases::NOMINATIVE->name => null,
        LanguageCases::GENITIVE->name => null,
        LanguageCases::ACCUSATIVE->name => null,
        LanguageCases::DATIVE->name => null,
        LanguageCases::INSTRUMENTAL->name => null,
        LanguageCases::PREPOSITIONAL->name => null,
    ];

    public function __construct(Word $word)
    {
        parent::__construct($word, Letters::CONSONANTS, ['ь']);
    }

    public function isSupport(): bool
    {
        $genderCompatible = Gender::FEMALE === $this->word->gender;
        $wordTypeCompatible = WordType::NAME === $this->word->wordType;

        return
            $genderCompatible
            && $wordTypeCompatible
            && $this->isEndingMatches();
    }
}
