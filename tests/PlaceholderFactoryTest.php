<?php

namespace Tests;

use LorenzoMilesi\Templates\PlaceholderFactory;
use LorenzoMilesi\Templates\PlaceholderInterface;
use LorenzoMilesi\Templates\Template;
use PHPUnit\Framework\TestCase;

class PlaceholderFactoryTest extends TestCase
{
    /**
     * @test
     * @covers \LorenzoMilesi\Templates\PlaceholderFactory::build
     */
    public function it_can_generate_placeholders(): void
    {
        $placeholder = PlaceholderFactory::build('[hello]', 'world');

        $this->assertInstanceOf(PlaceholderInterface::class, $placeholder);

        $template = Template::load('[hello]')->addPlaceholder($placeholder);

        $this->assertEquals('world', $template);
    }
}