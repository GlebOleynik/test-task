<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Rules;

final readonly class RulesSet
{
    /**
     * @return non-empty-list<class-string<AbstractRule>>
     */
    public static function getSets(): array
    {
        return [
            Priority1::class,
            Priority2::class,
            Priority3::class,
            Priority4::class,
            Priority5::class,
            Priority6::class,
            Priority7::class,
            Priority8::class,
            Priority9::class,
            Priority10::class,
            Priority11::class,
            Priority12::class,
            Priority13::class,
            Priority14::class,
            Priority15::class,
            Priority16::class,
            Priority17::class,
            Priority18::class,
            Priority19::class,
            Priority20::class,
        ];
    }
}
