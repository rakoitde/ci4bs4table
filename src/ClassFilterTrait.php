<?php

namespace Rakoitde\ci4bs4table;

trait ClassFilterTrait
{

    protected array $classfilter;

    private function addClassFilter(string $class, string $field, string $operator, string $value, string $format = null)
    {
        $classfilter = new \stdClass();
        $classfilter->class    = $class;
        $classfilter->field    = $field;
        $classfilter->operator = $operator;
        $classfilter->value    = $value;
        $classfilter->format   = $format;
        $this->classfilter[] = $classfilter;
    }

    public function Active(string $field, string $operator, string $value, string $format = null): self
    {
        $this->addClassFilter("table-active", $field, $operator, $value, $format);
        return $this;
    }

    public function Primary(string $field, string $operator, string $value, string $format = null): self
    {
        $this->addClassFilter("table-primary", $field, $operator, $value, $format);
        return $this;
    }

    public function Secondary(string $field, string $operator, string $value, string $format = null): self
    {
        $this->addClassFilter("table-secondary", $field, $operator, $value, $format);
        return $this;
    }

    public function Success(string $field, string $operator, string $value, string $format = null): self
    {
        $this->addClassFilter("table-success", $field, $operator, $value, $format);
        return $this;
    }

    public function Warning(string $field, string $operator, string $value, string $format = null): self
    {
        $this->addClassFilter("table-warning", $field, $operator, $value, $format);
        return $this;
    }

    public function Danger(string $field, string $operator, string $value, string $format = null): self
    {
        $this->addClassFilter("table-danger", $field, $operator, $value, $format);
        return $this;
    }

    public function Info(string $field, string $operator, string $value, string $format = null): self
    {
        $this->addClassFilter("table-info", $field, $operator, $value, $format);
        return $this;
    }

    public function Light(string $field, string $operator, string $value, string $format = null): self
    {
        $this->addClassFilter("table-light", $field, $operator, $value, $format);
        return $this;
    }

    public function Dark(string $field, string $operator, string $value, string $format = null): self
    {
        $this->addClassFilter("table-dark", $field, $operator, $value, $format);
        return $this;
    }

    public function getFilteredClasses($row): array
    {

        $parser = \Config\Services::parser();

        $classes = [];

        if (!isset($this->classfilter)) { return $classes; }

        foreach ($this->classfilter as $filter) {

            $field = $parser->setData($row)->renderString($filter->field);
            $value = $parser->setData($row)->renderString($filter->value);

            if ($this->type=="date" || $this->type=="datetime") {
                $field = date_create($field);
                $value = date_create($value);
            }

            switch ($filter->operator) {
                case '==':
                    if ($field == $value) { $classes[] = $filter->class; } 
                    break;
                case '!=':
                    if ($field != $value) { $classes[] = $filter->class; } 
                    break;
                case '>=':
                    if ($field >= $value) { $classes[] = $filter->class; } 
                    break;
                case '<=':
                    if ($field <= $value) { $classes[] = $filter->class; } 
                    break;
                case '>':
                    if ($field > $value) { $classes[] = $filter->class; } 
                    break;
                case '<':
                    if ($field < $value) { $classes[] = $filter->class; } 
                    break;
                case 'in':
                    if (in_array($field, explode(",", $filter->value))) { $classes[] = $filter->class; } 
                    break;
                case '!in':
                    if (!in_array($field, explode(",", $filter->value))) { $classes[] = $filter->class; } 
                    break;
                case 'between':
                    $v = explode(",",$filter->value);
                    if ($field >= $v[0] && $field <= $v[1]) { $classes[] = $filter->class; } 
                    break;
                default:
                    # code...
                    break;
            }
        }

        return $classes;
    }

    public function __construct()
    {

    }

}
