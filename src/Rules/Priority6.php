<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Rules;

use Goleynik\WordsDeclension\Refference\Gender;
use Goleynik\WordsDeclension\Refference\LanguageCases;
use Goleynik\WordsDeclension\Refference\Letters;
use Goleynik\WordsDeclension\Refference\WordType;
use Goleynik\WordsDeclension\Word;

class Priority6 extends AbstractRule
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
        $endings = array_values(array_diff(Letters::VOWELS, ['а', 'я']));
        parent::__construct($word, $endings);
    }

    public function isSupport(): bool
    {
        $genderCompatible = (Gender::MALE === $this->word->gender || Gender::FEMALE === $this->word->gender);
        $wordTypeCompatible = (WordType::NAME === $this->word->wordType || WordType::SURNAME === $this->word->wordType);

        return
            $genderCompatible
            && $wordTypeCompatible
            && $this->isEndingMatches();
    }
}
