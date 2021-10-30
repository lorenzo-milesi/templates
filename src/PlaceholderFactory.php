<?php

namespace LorenzoMilesi\Templates;

class PlaceholderFactory
{
    public static function build(string $tag, string $value): Placeholder
    {
        return new class($tag, $value) extends Placeholder {
            protected static string $value;

            public function __construct(string $tag, string $value) {
                static::$tag = $tag;
                static::$value = $value;
            }

            public static function value(): string
            {
                return static::$value;
            }
        };
    }
}