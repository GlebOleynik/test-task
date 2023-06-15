<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Rules;

use Goleynik\WordsDeclension\Refference\Gender;
use Goleynik\WordsDeclension\Refference\LanguageCases;
use Goleynik\WordsDeclension\Refference\Letters;
use Goleynik\WordsDeclension\Refference\WordType;
use Goleynik\WordsDeclension\Word;

class Priority18 extends AbstractRule
{
    public const ENDING_REPLACE = [
        LanguageCases::NOMINATIVE->name => null,
        LanguageCases::GENITIVE->name => 'и',
        LanguageCases::ACCUSATIVE->name => 'е',
        LanguageCases::DATIVE->name => 'ю',
        LanguageCases::INSTRUMENTAL->name => 'ой',
        LanguageCases::PREPOSITIONAL->name => 'е',
    ];

    private const ENDINGS = [
        'я',
    ];

    public function __construct(Word $word)
    {
        parent::__construct($word, self::ENDINGS, [], Letters::CONSONANTS);
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
