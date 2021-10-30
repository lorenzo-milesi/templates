<?php

namespace Tests\Placeholders;

use LorenzoMilesi\Templates\Placeholder;

class ExamplePlaceholder extends Placeholder
{
    protected static string $tag = '[placeholder]';

    public static function value(): string
    {
        return 'test';
    }
}