<?php

namespace LorenzoMilesi\Templates;

interface PlaceholderInterface
{
    public static function up(): static;

    public static function value(): string;
}