<?php

namespace Rakoitde\ci4bs4table;

class Filter
{

    protected string $field;

    protected bool $filtered = false;

    protected string $filtertype = "text";

    protected array $filteroptions = [];

    protected string $filter = "";

    protected array $values = [];

    protected array $queries = [];

    private $parser;

    public function Field(string $field)
    {
        $this->field = $field;
    }

    public function Type(string $type = "text"): self
    {

        $types=["text","checkbox"];
        $this->filtered = true;
        $this->filtertype = in_array($type, $types) ? $type : "text";

        return $this;
    }

    public function Values($values): self
    {
        $this->values = $values;
        return $this;
    }

    public function Options(array $options = []): self
    {

        $this->filteroptions = $options;

        return $this;
    }

    public function createQueries(): array
    {
        $filtervar = $this->config->filtervar;

        foreach ($this->values as $key => $value) {

            if ($value!="" && is_string($value)) {
                $this->queries[] = "&{$filtervar}[{$key}]={$value}";
            }

            if (is_array($value)) {
                foreach ($value as $k => $val) {
                    $this->queries[] = "&{$filtervar}[{$key}][{$k}]={$val}";
                }
            }
        }

        return $this->queries;
    }

    public function getQueries(): string
    {
        $q = implode("",$this->queries);
        return $q;

    }

    public function getFormField(): string
    {
        $html = $this->filtertype == "checkbox" ? $this->getCheckboxField() : $this->getTextField();
        return $html;
    }

    public function getTextField(): string
    {

        $data = [
            "field"     => $this->field,
            "filtervar" => $this->config->filtervar,
            "value"     => $this->values[$this->field] ?? '',
        ];

        $html = view('Rakoitde\ci4bs4table\Views\TextField', $data);

        return $html;
    }

    public function getCheckboxField(): string
    {

        $data = [
            "values"        => $this->values,
            "field"         => $this->field,
            "filtervar"     => $this->config->filtervar,
            "value"         => $this->values[$this->field] ?? '',
            "filteroptions" => $this->filteroptions
        ];

        $html = view('Rakoitde\ci4bs4table\Views\CheckBox', $data);

        return $html;
    }

    public function debug(): self
    {
        d( $this->createQueries() );
        d( $this->getQueries()    );
        return $this;
    }

    public function __construct(string $type = "text", array $options = [])
    {
        $this->filtertype = $type;
        $this->options = $options;
        $this->config = new \Rakoitde\ci4bs4table\Config\Config();
        $this->parser = \Config\Services::parser();
    }

}
