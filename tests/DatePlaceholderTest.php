<?php

namespace Tests;

use Carbon\Carbon;
use LorenzoMilesi\Templates\Template;
use PHPUnit\Framework\TestCase;
use Tests\Placeholders\DatePlaceholder;

class DatePlaceholderTest extends TestCase
{
    /**
     * @test
     * @covers \Tests\Placeholders\DatePlaceholder::value
     */
    public function it_can_replace_date(): void
    {
        $template = Template::load('Today is [date]');

        $template->addPlaceholder(DatePlaceholder::up());

        $today = Carbon::today()->format('Y-m-d');

        $this->assertEquals("Today is $today", $template);
    }
}