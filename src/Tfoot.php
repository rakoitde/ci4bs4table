<?php

namespace Rakoitde\ci4bs4table;

class Tfoot extends TableElement
{

    public array $cols = [];

    public function Dark(): self
    {
        $this->addClass("thead-dark");
        return $this;
    }
 
    public function Light(): self
    {
        $this->addClass("thead-light");
        return $this;
    }

    public function Th(string $text): Th
    {
        $th = new Th($text);
        $th->BaseUrl($this->baseurl);
        $th->Values($this->values);
        $this->cols[] = $th;
        return $th;
    }

    public function Td(string $text = ""): Td
    {
        $th = new Td($text);
        $th->BaseUrl($this->baseurl);
        $th->Values($this->values);
        $this->cols[] = $th;
        return $th;
    }

    public function toHtml(): string
    {
        if (count($this->cols)==0) { return ""; }
        $thead = "\t".'<thead class="'.$this->getClasses().'">'.PHP_EOL;
        $thead.= "\t\t<tr>".PHP_EOL;
        foreach ($this->cols as $col) {
            $thead.= $col->toHtml();
        }
        $thead.= "\t\t</tr>".PHP_EOL;
        $thead.= "\t".'</thead>'.PHP_EOL;
        return $thead;
    }

    public function __construct()
    {

    }

}
