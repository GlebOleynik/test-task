<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Rules;

use Goleynik\WordsDeclension\Refference\Gender;
use Goleynik\WordsDeclension\Refference\LanguageCases;
use Goleynik\WordsDeclension\Refference\Letters;
use Goleynik\WordsDeclension\Refference\WordType;
use Goleynik\WordsDeclension\Word;

class Priority1 extends AbstractRule
{
    // здесь я бы скорее реализовал через самописную HashMap, которая в ключах поддерживает не только строки
    // или попробовал использовать DS/Map
    public const ENDING_REPLACE = [
        LanguageCases::NOMINATIVE->name => null,
        LanguageCases::GENITIVE->name => null,
        LanguageCases::ACCUSATIVE->name => null,
        LanguageCases::DATIVE->name => null,
        LanguageCases::INSTRUMENTAL->name => null,
        LanguageCases::PREPOSITIONAL->name => null,
    ];

    /**
     * @psalm-suppress RedundantFunctionCall
     */
    public function __construct(Word $word)
    {
        $endings = array_values(array_merge(Letters::CONSONANTS, ['ь']));
        parent::__construct($word, $endings);
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
