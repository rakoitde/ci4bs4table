<?php

namespace Rakoitde\ci4bs4table;

class Thead extends TableElement
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
        $th->Uri($this->uri);
        $th->Values($this->values);
        $th->Text($text);
        $th->_fields = $this->_fields;
        $this->cols[] = $th;
        return $th;
    }

    public function getAllFilterQueries() 
    {
        $q = [];
        foreach ($this->cols as $col) {
            if (isset($col->_filter)) {
                $col->_filter->createQueries();
                $q[] = $col->_filter->getQueries();
            }
        }
        return implode("", $q);
    }

    public function toHtml(): string
    {

        $options['filterqueries'] = $this->getAllFilterQueries();

        $thead = "\t".'<thead class="'.$this->getClasses().'">'.PHP_EOL;
$thead.='<form class="px-4 py-3" method="get" action="'.$this->uri.'">';
        $thead.= "\t\t<tr>".PHP_EOL;
        foreach ($this->cols as $col) {
            $thead.= $col->toHtml($options);
        }
        $thead.= "\t\t</tr>".PHP_EOL;
$thead.='</form>';
        $thead.= "\t".'</thead>'.PHP_EOL;
        return $thead;
    }

    public function __construct()
    {

    }

}
