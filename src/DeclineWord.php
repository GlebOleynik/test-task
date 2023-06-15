<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension;

use Goleynik\WordsDeclension\Refference\LanguageCases;
use Goleynik\WordsDeclension\Rules\AbstractRule;
use Goleynik\WordsDeclension\Rules\RulesSet;

class DeclineWord
{
    private ?AbstractRule $matchedRule = null;

    public function __construct(private readonly Word $word)
    {
        foreach (RulesSet::getSets() as $ruleClassName) {
            $rule = new $ruleClassName($word);

            if ($rule->isSupport()) {
                $this->matchedRule = $rule;

                break;
            }
        }
    }

    /**
     * @throws \Exception
     */
    public function declineInAllCases(): array
    {
        if (!$this->matchedRule instanceof AbstractRule) {
            throw new \Exception('No rule matches word parameters');
        }

        $declinedWord = [];

        /** @var LanguageCases $case */
        foreach ($this->matchedRule::ENDING_REPLACE as $case => $_) {
            // Если бы в ENDING_REPLACE использовалась бы HashMap, то не пришлось бы использовать рефлексию для получения значения,
            // либо надо написать функцию получения LanguageCases по имени case.
            $declinedWord[(new \ReflectionEnum(LanguageCases::class))->getCase($case)->getValue()->value] = $this->declineInOneCase($case);
        }

        return $declinedWord;
    }

    // логика работы упрощена до "всегда заменяем" что неправильно и действует не для всех наборов правил.
    // В ряде случаев необходимо добавлять окончание, а не заменять, вводные данные информации о замене/добавлении окончания
    // не содержат
    /**
     * @throws \Exception
     */
    public function declineInOneCase(string $caseName): string
    {
        if (!$this->matchedRule instanceof AbstractRule) {
            throw new \Exception('No rule matches word parameters');
        }

        $newEnding = (null === $this->matchedRule::ENDING_REPLACE[$caseName]) ? '' : $this->matchedRule::ENDING_REPLACE[$caseName];
        if ('' === $newEnding) {
            return $this->word->word;
        }

        $wordLength = mb_strlen($this->word->word);
        $lengthWithoutEnding = $wordLength - mb_strlen($this->matchedRule->foundEnding);

        return mb_substr($this->word->word, 0, $lengthWithoutEnding).$newEnding;
    }
}
