<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Alt;

final readonly class WordDecliner
{
    /**
     * @var array<non-empty-string, array<non-empty-string, non-empty-list<Rule>>>
     */
    private array $rulesByGenderByType;

    /**
     * @param iterable<Rule> $rules
     */
    public function __construct(
        iterable $rules = [
            new Rule\Rule1(),
            new Rule\Rule8(),
            new Rule\Rule17(),
        ],
    ) {
        $rulesByGenderByType = [];

        foreach ($rules as $rule) {
            foreach ($rule->supportedGenders() as $gender) {
                foreach ($rule->supportedTypes() as $type) {
                    $rulesByGenderByType[$gender->name][$type->name][] = $rule;
                }
            }
        }

        $this->rulesByGenderByType = $rulesByGenderByType;
    }

    public function declineWord(Word $word): DeclinedWord
    {
        foreach ($this->rulesByGenderByType[$word->gender->name][$word->type->name] ?? [] as $rule) {
            if ($rule->supportsWord($word->word)) {
                return $rule->decline($word->word);
            }
        }

        throw new \LogicException();
    }
}
