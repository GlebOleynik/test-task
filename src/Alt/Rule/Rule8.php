<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Alt\Rule;

use Goleynik\WordsDeclension\Alt\Declination;
use Goleynik\WordsDeclension\Alt\DeclinedWord;
use Goleynik\WordsDeclension\Alt\Rule;
use Goleynik\WordsDeclension\Alt\Gender;
use Goleynik\WordsDeclension\Alt\Word;

final readonly class Rule8 implements Rule
{
    public const ENDING = 'ь';

    public function supports(Word $word): bool
    {
        return $word->genderIs(Gender::MALE) && str_ends_with($word->word, self::ENDING);
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
