<?php

namespace LorenzoMilesi\Templates;

class Template
{
    protected Placeholders $placeholders;

    public function __construct(protected string $content)
    {
        $this->placeholders = new Placeholders();
    }

    public static function load(string $content): self
    {
        return new static($content);
    }

    public function __toString(): string
    {
        foreach ($this->placeholders as $placeholder) {
            $this->content = $placeholder->replace($this->content);
        }

        return $this->content;
    }

    public function addPlaceholder(PlaceholderInterface $placeholder): self
    {
        $this->placeholders->push($placeholder);

        return $this;
    }
}