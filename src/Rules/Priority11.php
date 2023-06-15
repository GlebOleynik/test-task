<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Rules;

use Goleynik\WordsDeclension\Refference\Gender;
use Goleynik\WordsDeclension\Refference\LanguageCases;
use Goleynik\WordsDeclension\Refference\WordType;
use Goleynik\WordsDeclension\Word;

class Priority11 extends AbstractRule
{
    public const ENDING_REPLACE = [
        LanguageCases::NOMINATIVE->name => null,
        LanguageCases::GENITIVE->name => 'а',
        LanguageCases::ACCUSATIVE->name => 'у',
        LanguageCases::DATIVE->name => 'а',
        LanguageCases::INSTRUMENTAL->name => 'ом',
        LanguageCases::PREPOSITIONAL->name => 'е',
    ];

    private const ENDINGS = [
        'б',
        'г',
        'д',
        'з',
        'к',
        'м',
        'н',
        'п',
        'р',
        'с',
        'т',
        'ф',
        'х',
        'ч',
    ];

    public function __construct(Word $word)
    {
        // Здесь упрощена логика работы с предшествующей буквой
        parent::__construct($word, self::ENDINGS, [], ['a']);
    }

    public function isSupport(): bool
    {
        $genderCompatible = Gender::MALE === $this->word->gender;
        $wordTypeCompatible = WordType::SURNAME === $this->word->wordType;

        return
            $genderCompatible
            && $wordTypeCompatible
            && $this->isEndingMatches();
    }
}
