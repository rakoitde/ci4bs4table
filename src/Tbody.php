<?php

namespace Rakoitde\ci4bs4table;

class Tbody extends TableElement
{

    use ClassFilterTrait;

    protected $entities;

    public array $cols;

    protected array $rows;

    protected array $classfilter;

    public function addEntities($entities): self
    {
        $this->entities = $entities;
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

    public function Td(string $text = "", string $condition = ""): Td
    {
        $th = new Td($text, $condition);
        $th->BaseUrl($this->baseurl);
        $th->Values($this->values);
        $this->cols[] = $th;
        return $th;
    }

    public function toHtml(): string
    {
        $tbody = "\t".'<tbody>'.PHP_EOL;
        foreach ($this->entities as $obj) {
            $row = $obj->toRawArray();
            $classes = trim($this->getClasses().' '.implode(" ", $this->getFilteredClasses($obj->toArray())));
            $tbody.= "\t\t".'<tr class="'.$classes.'">'.PHP_EOL;
                foreach ($this->cols as $col) {
                    $col->text = $row[$col->field] ?? "";
                    $col->Values($obj->toArray());
                    $tbody.= $col->toHtml();
                }
            $tbody.= "\t\t</tr>".PHP_EOL;

        }

        $tbody.= "\t".'</tbody>'.PHP_EOL;
        return $tbody;
    }

}
