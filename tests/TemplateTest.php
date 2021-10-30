<?php

namespace Tests;

use LorenzoMilesi\Templates\Template;
use PHPUnit\Framework\TestCase;
use Tests\Placeholders\AnotherExamplePlaceholder;
use Tests\Placeholders\ExamplePlaceholder;

class TemplateTest extends TestCase
{
    /**
     * @test
     * @covers \LorenzoMilesi\Templates\Template::load
     */
    public function it_can_load_a_content(): void
    {
        $template = Template::load('Hello');

        $this->assertEquals('Hello', $template);
    }

    /**
     * @test
     * @covers \LorenzoMilesi\Templates\Template::__toString
     */
    public function it_can_replace_a_given_placeholder(): void
    {
        $template = Template::load('[placeholder]');
        $template->addPlaceholder(ExamplePlaceholder::up());

        $this->assertEquals('test', $template);
    }

    /**
     * @test
     * @covers \LorenzoMilesi\Templates\Template::__toString
     */
    public function it_can_replace_placeholders_anywhere(): void
    {
        $template = Template::load('hello [placeholder]');
        $template->addPlaceholder(new ExamplePlaceholder());

        $this->assertEquals('hello test', $template);
    }

    /**
     * @test
     * @covers \LorenzoMilesi\Templates\Template::__toString
     */
    public function it_can_have_different_placeholders(): void
    {
        $template = Template::load('hello [placeholder], [another_placeholder]');
        $template->addPlaceholder(ExamplePlaceholder::up())
            ->addPlaceholder(AnotherExamplePlaceholder::up());

        $this->assertEquals('hello test, another test', $template);
    }
}
