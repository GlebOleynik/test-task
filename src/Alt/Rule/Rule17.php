<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Alt\Rule;

use Goleynik\WordsDeclension\Alt\Declination;
use Goleynik\WordsDeclension\Alt\DeclinedWord;
use Goleynik\WordsDeclension\Alt\Rule;
use Goleynik\WordsDeclension\Alt\Gender;
use Goleynik\WordsDeclension\Alt\Type;

final readonly class Rule17 implements Rule
{
    public function supportedGenders(): array
    {
        return [Gender::MALE];
    }

    public function supportedTypes(): array
    {
        return [Type::NAME];
    }

    public function tryDecline(string $word): ?DeclinedWord
    {
        if (preg_match('/(.*[бвгджзйклмнпрстфхцчшщ])а$/', $word, $matches) !== 1) {
            return null;
        }

        return DeclinedWord::fromPairs([
            [Declination::NOMINATIVE, $word],
            [Declination::GENITIVE, $matches[1].'ю'],
            [Declination::ACCUSATIVE, $matches[1].'ю'],
            [Declination::DATIVE, $matches[1].'ю'],
            [Declination::INSTRUMENTAL, $matches[1].'ю'],
            [Declination::PREPOSITIONAL, $matches[1].'ю'],
        ]);
    }
}
