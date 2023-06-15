<?php

declare(strict_types=1);

namespace Goleynik\WordsDeclension\Refference;

enum LanguageCases: string
{
    case NOMINATIVE = 'Именительный';

    case GENITIVE = 'Родительный';

    case ACCUSATIVE = 'Винительный';

    case DATIVE = 'Дательный';

    case INSTRUMENTAL = 'Творительный';

    case PREPOSITIONAL = 'Предложный';
}
