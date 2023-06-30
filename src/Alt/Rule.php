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
    public function supportsWord(string $word): bool;

    /**
     * @param non-empty-string $word
     */
    public function decline(string $word): DeclinedWord;
}
