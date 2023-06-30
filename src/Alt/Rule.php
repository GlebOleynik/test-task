<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Alt;

use Goleynik\WordsDeclension\Alt\Word;

interface Rule
{
    public function supports(Word $word): bool;

    public function decline(Word $word): DeclinedWord;
}
