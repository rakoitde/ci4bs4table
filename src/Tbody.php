<?php

namespace Rakoitde\ci4bs4table;

class Tbody extends TableElement
{

    use ClassFilterTrait;

    protected $entities;

    public array $cols = [];

    protected array $rows;

    protected array $classfilter;

    public function formatRows()
    {
        foreach ($this->cols as $col) {
            if ($col->field!="" && $col->type!="text")
            {
                $field = new \stdClass(); 
                $field->type = $col->type;
                $field->format = $col->format;
                $format[$col->field] = $field;
            }
        }
    }

    public function addEntities($entities): self
    {
        $this->entities = $entities;
        return $this;
    }

    public function Th(string $text): Th
    {
        $th = new Th($text);
        $th->Uri($this->uri);
        $th->Values($this->values);
        $this->cols[] = $th;
        return $th;
    }

    public function Td(string $text = "", string $condition = ""): Td
    {
        $th = new Td($text, $condition);
        $th->Uri($this->uri);
        $th->Values($this->values);
        $th->_fields = $this->_fields;
        $this->cols[] = $th;
        return $th;
    }

    public function toHtml(): string
    {

#$this->formatRows();

        $tbody = "\t".'<tbody>'.PHP_EOL;
        foreach ($this->entities as $obj) {
            $row = $obj->toRawArray();

            $classes = trim($this->getClasses().' '.implode(" ", $this->getFilteredClasses($obj->toArray())));
            $tbody.= "\t\t".'<tr class="'.$classes.'">'.PHP_EOL;
                foreach ($this->cols as $col) {

                    if ($col->type=="date" || $col->type=="datetime") {
                        if ($row[$col->field]!="") {
                            $format = $col->format != "" ? $col->format : $col->config->format[$col->type];
                            $date = date_create($row[$col->field]);
                            $row[$col->field] = date_format($date,$format);
                        }
                    }

                    if ($col->type=="currency") {
                        if ($row[$col->field]!="") {
                            $format = $col->format != "" ? $col->format : $col->config->format[$col->type];
                            $row[$col->field] = number_to_currency($row[$col->field], $format);
                        }
                    }

                    if ($col->type=="decimal") {
                        if ($row[$col->field]!="") {
                            $precision = $col->format != "" ? intval($col->format) : intval($col->config->format[$col->type]);
                            $row[$col->field] = number_format($row[$col->field], $precision, ',', '.');
                        }
                    }

                    $col->Text($row[$col->field] ?? "");
                    $col->Values($row);
                    $tbody.= $col->toHtml();
                }
            $tbody.= "\t\t</tr>".PHP_EOL;

        }

        $tbody.= "\t".'</tbody>'.PHP_EOL;
        return $tbody;
    }

}
