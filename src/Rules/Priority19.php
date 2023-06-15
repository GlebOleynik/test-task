<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Rules;

use Goleynik\WordsDeclension\Refference\Gender;
use Goleynik\WordsDeclension\Refference\LanguageCases;
use Goleynik\WordsDeclension\Refference\WordType;
use Goleynik\WordsDeclension\Word;

class Priority19 extends AbstractRule
{
    public const ENDING_REPLACE = [
        LanguageCases::NOMINATIVE->name => null,
        LanguageCases::GENITIVE->name => 'ы',
        LanguageCases::ACCUSATIVE->name => 'е',
        LanguageCases::DATIVE->name => 'у',
        LanguageCases::INSTRUMENTAL->name => 'ой',
        LanguageCases::PREPOSITIONAL->name => 'е',
    ];

    private const ENDINGS = [
        'а',
    ];

    public function __construct(Word $word)
    {
        parent::__construct($word, self::ENDINGS);
    }

    public function isSupport(): bool
    {
        $genderCompatible = (Gender::MALE === $this->word->gender || Gender::FEMALE === $this->word->gender);
        $wordTypeCompatible = WordType::NAME === $this->word->wordType;

        return
            $genderCompatible
            && $wordTypeCompatible
            && $this->isEndingMatches();
    }
}
