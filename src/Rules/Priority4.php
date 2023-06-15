<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Rules;

use Goleynik\WordsDeclension\Refference\Gender;
use Goleynik\WordsDeclension\Refference\LanguageCases;
use Goleynik\WordsDeclension\Refference\WordType;
use Goleynik\WordsDeclension\Word;

class Priority4 extends AbstractRule
{
    public const ENDING_REPLACE = [
        LanguageCases::NOMINATIVE->name => null,
        LanguageCases::GENITIVE->name => null,
        LanguageCases::ACCUSATIVE->name => null,
        LanguageCases::DATIVE->name => null,
        LanguageCases::INSTRUMENTAL->name => null,
        LanguageCases::PREPOSITIONAL->name => null,
    ];

    private const ENDINGS = [
        'иа',
        'ия',
    ];

    public function __construct(Word $word)
    {
        parent::__construct($word, self::ENDINGS);
    }

    public function isSupport(): bool
    {
        $genderCompatible = (Gender::MALE === $this->word->gender || Gender::FEMALE === $this->word->gender);
        $wordTypeCompatible = WordType::SURNAME === $this->word->wordType;

        return
            $genderCompatible
            && $wordTypeCompatible
            && $this->isEndingMatches();
    }
}
