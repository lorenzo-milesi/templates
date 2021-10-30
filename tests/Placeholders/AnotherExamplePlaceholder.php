<?php

namespace Tests\Placeholders;

use LorenzoMilesi\Templates\Placeholder;

class AnotherExamplePlaceholder extends Placeholder
{
    protected static string $tag = '[another_placeholder]';

    public static function value(): string
    {
        return 'another test';
    }
}