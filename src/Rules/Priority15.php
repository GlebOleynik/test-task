<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Rules;

use Goleynik\WordsDeclension\Refference\Gender;
use Goleynik\WordsDeclension\Refference\LanguageCases;
use Goleynik\WordsDeclension\Refference\WordType;
use Goleynik\WordsDeclension\Word;

class Priority15 extends AbstractRule
{
    public const ENDING_REPLACE = [
        LanguageCases::NOMINATIVE->name => null,
        LanguageCases::GENITIVE->name => 'и',
        LanguageCases::ACCUSATIVE->name => 'и',
        LanguageCases::DATIVE->name => null,
        LanguageCases::INSTRUMENTAL->name => null,
        LanguageCases::PREPOSITIONAL->name => 'и',
    ];

    private const ENDINGS = [
        'ь',
    ];

    public function __construct(Word $word)
    {
        parent::__construct($word, self::ENDINGS);
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
