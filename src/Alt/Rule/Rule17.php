<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Alt\Rule;

use Goleynik\WordsDeclension\Alt\Declination;
use Goleynik\WordsDeclension\Alt\DeclinedWord;
use Goleynik\WordsDeclension\Alt\Rule;
use Goleynik\WordsDeclension\Alt\Gender;
use Goleynik\WordsDeclension\Refference\Letters;
use Goleynik\WordsDeclension\Alt\Type;
use Goleynik\WordsDeclension\Alt\Word;

final readonly class Rule17 implements Rule
{
    public const ENDING = 'а';

    public function supports(Word $word): bool
    {
        if (!($word->genderIs(Gender::MALE) || $word->typeIs(Type::NAME))) {
            return false;
        }

        if ($word->word[-1] !== self::ENDING) {
            return false;
        }

        return in_array($word->word[-2] ?? '', Letters::CONSONANTS, true);
    }

    public function decline(Word $word): DeclinedWord
    {
        $wordWithoutEnding = mb_substr($word->word, 0, -1);

        return DeclinedWord::fromPairs([
            [Declination::NOMINATIVE, $word->word],
            [Declination::GENITIVE, $wordWithoutEnding.'ю'],
            [Declination::ACCUSATIVE, $wordWithoutEnding.'ю'],
            [Declination::DATIVE, $wordWithoutEnding.'ю'],
            [Declination::INSTRUMENTAL, $wordWithoutEnding.'ю'],
            [Declination::PREPOSITIONAL, $wordWithoutEnding.'ю'],
        ]);
    }
}
