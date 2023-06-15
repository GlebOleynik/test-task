<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Rules;

use Goleynik\WordsDeclension\Refference\Gender;
use Goleynik\WordsDeclension\Refference\LanguageCases;
use Goleynik\WordsDeclension\Refference\WordType;
use Goleynik\WordsDeclension\Word;

class Priority10 extends AbstractRule
{
    public const ENDING_REPLACE = [
        LanguageCases::NOMINATIVE->name => null,
        LanguageCases::GENITIVE->name => 'я',
        LanguageCases::ACCUSATIVE->name => 'ю',
        LanguageCases::DATIVE->name => 'я',
        LanguageCases::INSTRUMENTAL->name => 'ем',
        LanguageCases::PREPOSITIONAL->name => 'е',
    ];

    private const ENDINGS = [
        'й',
    ];

    public function __construct(Word $word)
    {
        parent::__construct($word, self::ENDINGS);
    }

    public function isSupport(): bool
    {
        $genderCompatible = Gender::MALE === $this->word->gender;
        $wordTypeCompatible = (WordType::NAME === $this->word->wordType || WordType::SURNAME === $this->word->wordType);

        return
            $genderCompatible
            && $wordTypeCompatible
            && $this->isEndingMatches();
    }
}
