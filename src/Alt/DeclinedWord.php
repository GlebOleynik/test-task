<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Alt;

use Goleynik\WordsDeclension\Alt\Word;

final readonly class DeclinedWord
{
    /**
     * @param non-empty-array<non-empty-string, non-empty-string> $declinedWords
     */
    private function __construct(
        private array $declinedWords,
    ) {
    }

    /**
     * @param non-empty-list<array{Declination, non-empty-string}> $pairs
     */
    public static function fromPairs(array $pairs): self
    {
        $declinedWords = [];

        foreach ($pairs as [$declination, $word]) {
            $declinedWords[$declination->value] = $word;
        }

        if (count($declinedWords) !== count(Declination::cases())) {
            throw new \InvalidArgumentException();
        }

        return new self($declinedWords);
    }

    /**
     * @param non-empty-string $word
     */
    public static function fromSingleWord(string $word): self
    {
        $declinedWords = [];

        foreach (Declination::cases() as $declination) {
            $declinedWords[$declination->value] = $word;
        }

        return new self($declinedWords);
    }

    /**
     * @return non-empty-string
     */
    public function get(Declination $declination): string
    {
        return $this->declinedWords[$declination->value] ?? throw new \LogicException();
    }
}
