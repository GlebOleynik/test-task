<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Alt;

use Goleynik\WordsDeclension\Alt\Rule\Rule1;
use Goleynik\WordsDeclension\Alt\Rule\Rule8;
use Goleynik\WordsDeclension\Alt\Word;

final readonly class WordDecliner
{
    /**
     * @param iterable<Rule> $rules
     */
    public function __construct(
        private iterable $rules = [
            new Rule1(),
            new Rule8(),
        ],
    ) {
    }

    public function declineWord(Word $word): DeclinedWord
    {
        foreach ($this->rules as $rule) {
            if ($rule->supports($word)) {
                return $rule->decline($word);
            }
        }

        throw new \LogicException();
    }
}
