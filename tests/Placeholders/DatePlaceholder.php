<?php

namespace Tests\Placeholders;

use Carbon\Carbon;
use LorenzoMilesi\Templates\Placeholder;

class DatePlaceholder extends Placeholder
{
    protected static string $tag = '[date]';

    public static function value(): string
    {
        return Carbon::today()->format('Y-m-d');
    }
}