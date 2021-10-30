<?php

namespace LorenzoMilesi\Templates;

abstract class Placeholder implements PlaceholderInterface
{
    protected static string $tag;

    public static function up(): static
    {
        return new static();
    }

    public function replace(string $content): string
    {
        return str_replace(static::$tag, static::value(), $content);
    }
}