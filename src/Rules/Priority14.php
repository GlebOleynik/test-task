<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Rules;

use Goleynik\WordsDeclension\Refference\Gender;
use Goleynik\WordsDeclension\Refference\LanguageCases;
use Goleynik\WordsDeclension\Refference\Letters;
use Goleynik\WordsDeclension\Refference\WordType;
use Goleynik\WordsDeclension\Word;

class Priority14 extends AbstractRule
{
    public const ENDING_REPLACE = [
        LanguageCases::NOMINATIVE->name => null,
        LanguageCases::GENITIVE->name => 'а',
        LanguageCases::ACCUSATIVE->name => 'у',
        LanguageCases::DATIVE->name => 'а',
        LanguageCases::INSTRUMENTAL->name => 'ом',
        LanguageCases::PREPOSITIONAL->name => 'е',
    ];

    public function __construct(Word $word)
    {
        parent::__construct($word, Letters::CONSONANTS);
    }

    public function isSupport(): bool
    {
        $genderCompatible = Gender::MALE === $this->word->gender;
        $wordTypeCompatible = WordType::NAME === $this->word->wordType;

        return
            $genderCompatible
            && $wordTypeCompatible
            && $this->isEndingMatches();
    }
}
