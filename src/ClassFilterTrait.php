<?php

namespace Rakoitde\ci4bs4table;

trait ClassFilterTrait
{

    protected array $classfilter;


    private function addFilteredClass(string $class, array $conditions = [], string $format = null)
    {
        $classfilter = new \stdClass();
        $classfilter->class    = $class;
        $classfilter->conditions = $conditions;
        $classfilter->format   = $format;
        $this->classfilter[] = $classfilter;
    }

    public function Active(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-active", $condition, $format);
        return $this;
    }

    public function Primary(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-primary", $condition, $format);
        return $this;
    }

    public function Secondary(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-secondary", $condition, $format);
        return $this;
    }

    public function Success(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-success", $condition, $format);
        return $this;
    }

    public function Warning(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-warning", $condition, $format);
        return $this;
    }

    public function Danger(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-danger", $condition, $format);
        return $this;
    }

    public function Info(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-info", $condition, $format);
        return $this;
    }

    public function Light(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-light", $condition, $format);
        return $this;
    }

    public function Dark(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-dark", $condition, $format);
        return $this;
    }

    public function getFilteredClasses($row): array
    {

        if (!is_array($row)) { $row = $row->toArray(); }

        $parser = \Config\Services::parser();

        $classes = [];

        if (!isset($this->classfilter)) { return $classes; }

        foreach ($this->classfilter as $filter) {

            list($operand_a, $operator, $operand_b) = $filter->conditions;

            $field = $parser->setData($row)->renderString($operand_a);
            $value = $parser->setData($row)->renderString($operand_b);
            if ((isset($this->formattype) ? $this->formattype=="date" : $this->type=="date") || 
                (isset($this->formattype) ? $this->formattype=="datetime" : $this->type=="datetime")) {
                $field = date_create($field);
                $value = date_create($value);
            }

            switch ($operator) {
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
#d([$field, $value, $filter->class, $classes]);
        }

        return $classes;
    }

    public function __construct()
    {

    }

}
