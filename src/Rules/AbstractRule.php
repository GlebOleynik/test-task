<?php

namespace Goleynik\WordsDeclension\Rules;

use Goleynik\WordsDeclension\Word;

abstract class AbstractRule
{
    /**
     * @psalm list<string, int>
     */
    protected readonly array $endings;

    /**
     * @psalm list<string, int>
     */
    protected readonly array $excludingEndings;

    /**
     * @psalm list<string, int>
     */
    protected readonly array $previousLetter;

    public ?string $foundEnding = null;

    protected const MAX_ENDINGS_LENGTH = 3;

    /**
     * @param list<string> $endings
     * @param list<string> $excludingEndings
     * @param list<string> $previousLetter
     */
    public function __construct(
        protected readonly Word $word,
        array $endings,
        array $excludingEndings = [],
        array $previousLetter = [],
    ) {
        $this->endings = array_flip($endings);
        $this->excludingEndings = array_flip($excludingEndings);
        $this->previousLetter = array_flip($previousLetter);
    }

    abstract public function isSupport(): bool;

    /**
     * @return list<string>
     */
    private function getMultipleEndings(Word $word): array
    {
        $maxLength = min(mb_strlen($word->word), self::MAX_ENDINGS_LENGTH);

        $wordEndings = [];
        // можно решить отсчетом от 0 и увеличением требуемого значения на 1 в функции mb_substr
        // или отсчетом от 1, что по мне более читаемо
        for ($i = 1; $i <= $maxLength; ++$i) {
            $wordEndings[] = mb_substr($word->word, -$i);
        }

        return $wordEndings;
    }

    protected function isEndingMatches(): bool
    {
        $wordEndingsVariant = $this->getMultipleEndings($this->word);

        foreach ($wordEndingsVariant as $ending) {
            if (
                !$this->isInEndlingsList($this->excludingEndings, $ending)
                && $this->isInEndlingsList($this->endings, $ending)
                && !$this->isPreviousLetterMatch($ending)
            ) {
                $this->foundEnding = $ending;

                return true;
            }
        }

        return false;
    }

    private function isInEndlingsList(array $endings, string $ending): bool
    {
        return isset($endings[$ending]);
    }

    private function isPreviousLetterMatch(string $ending): bool
    {
        $endingLength = mb_strlen($ending);
        $wordPreviousLetter = mb_substr($this->word->word, -($endingLength + 1), 1);

        return isset($this->previousLetter[$wordPreviousLetter]);
    }
}
