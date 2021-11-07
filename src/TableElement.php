<?php

namespace Rakoitde\ci4bs4table;
 

class TableElement
{

	private array $classes;

    protected string $uri;

    protected array $values;

    public function addClass(string $class): self
    {
        $classes = explode(" ", $class);
        foreach ($classes as $class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function getClasses(): string
    {
        return isset($this->classes) ? implode(" ", $this->classes) : "";
    }

    public function Uri(string $uri): self
    {
        $this->uri = $uri;
        return $this;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function Values($values): self
    {
        $this->values = $values;
        return $this;
    }

}
