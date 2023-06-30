<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Alt\Rule;

use Goleynik\WordsDeclension\Alt\DeclinedWord;
use Goleynik\WordsDeclension\Alt\Rule;
use Goleynik\WordsDeclension\Alt\Gender;
use Goleynik\WordsDeclension\Refference\Letters;
use Goleynik\WordsDeclension\Alt\Type;
use Goleynik\WordsDeclension\Alt\Word;

final readonly class Rule1 implements Rule
{
    public const ENDINGS = [...Letters::CONSONANTS, 'ь'];

    public function supports(Word $word): bool
    {
        if (!($word->genderIs(Gender::FEMALE) && $word->typeIs(Type::SURNAME))) {
            return false;
        }

        foreach (self::ENDINGS as $ending) {
            if (str_ends_with($word->word, $ending)) {
                return true;
            }
        }

        return false;
    }

    public function decline(Word $word): DeclinedWord
    {
        return DeclinedWord::fromSingleWord($word->word);
    }
}
