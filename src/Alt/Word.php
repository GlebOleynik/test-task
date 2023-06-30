<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Alt;

final readonly class Word
{
    /**
     * @param non-empty-string $word
     */
    public function __construct(
        private Gender $gender,
        private Type $type,
        public string $word,
    ) {
    }

    public function genderIs(Gender $gender): bool
    {
        return $this->gender === $gender;
    }

    public function typeIs(Type $type): bool
    {
        return $this->type === $type;
    }
}
