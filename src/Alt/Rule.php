<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Alt;

interface Rule
{
    /**
     * @return non-empty-list<Gender>
     */
    public function supportedGenders(): array;

    /**
     * @return non-empty-list<Type>
     */
    public function supportedTypes(): array;

    /**
     * @param non-empty-string $word
     */
    public function tryDecline(string $word): ?DeclinedWord;
}
