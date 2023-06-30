<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Alt\Rule;

use Goleynik\WordsDeclension\Alt\Declination;
use Goleynik\WordsDeclension\Alt\DeclinedWord;
use Goleynik\WordsDeclension\Alt\Rule;
use Goleynik\WordsDeclension\Alt\Gender;
use Goleynik\WordsDeclension\Alt\Type;

final readonly class Rule8 implements Rule
{
    public const ENDING = 'ь';

    public function supportedGenders(): array
    {
        return [Gender::MALE];
    }

    public function supportedTypes(): array
    {
        return Type::cases();
    }

    public function supportsWord(string $word): bool
    {
        return str_ends_with($word, self::ENDING);
    }

    public function decline(string $word): DeclinedWord
    {
        $wordWithoutEnding = mb_substr($word, 0, -1);

        return DeclinedWord::fromPairs([
            [Declination::NOMINATIVE, $word],
            [Declination::GENITIVE, $wordWithoutEnding.'ю'],
            [Declination::ACCUSATIVE, $wordWithoutEnding.'ю'],
            [Declination::DATIVE, $wordWithoutEnding.'ю'],
            [Declination::INSTRUMENTAL, $wordWithoutEnding.'ю'],
            [Declination::PREPOSITIONAL, $wordWithoutEnding.'ю'],
        ]);
    }
}
