<?php

namespace Rakoitde\ci4bs4form;

class CloseDiv extends FormElement
{

    public function toHtml(): string
    {
        $html = '</div>'.PHP_EOL;

        return $html;
    }

    public function __construct(string $id)
    {
        parent::__construct($id);
        $this->type = "divclose";
    }

}
