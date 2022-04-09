<?php

namespace Rakoitde\Ci4bs4table;

/**
 * Filter functions
 */
trait ClassFilterTrait
{

    protected array $classfilter;


    /**
     * Adds a filtered class.
     *
     * @param      string  $class       The class
     * @param      array   $conditions  The conditions
     * @param      string  $format      The format
     */
    private function addFilteredClass(string $class, array $conditions = [], string $format = null)
    {
        $classfilter = new \stdClass();
        $classfilter->class    = $class;
        $classfilter->conditions = $conditions;
        $classfilter->format   = $format;
        $this->classfilter[] = $classfilter;
    }

    /**
     * Adds the class table-active if condition is true
     *
     * @param      array   $condition  The condition
     * @param      string  $format     The format
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function Active(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-active", $condition, $format);
        return $this;
    }

    /**
     * Adds the class table-primary if condition is true
     *
     * @param      array   $condition  The condition
     * @param      string  $format     The format
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function Primary(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-primary", $condition, $format);
        return $this;
    }

    /**
     * Adds the class table-secondary if condition is true
     *
     * @param      array   $condition  The condition
     * @param      string  $format     The format
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function Secondary(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-secondary", $condition, $format);
        return $this;
    }

    /**
     * Adds the class table-success if condition is true
     *
     * @param      array   $condition  The condition
     * @param      string  $format     The format
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function Success(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-success", $condition, $format);
        return $this;
    }

    /**
     * Adds the class table-warning if condition is true
     *
     * @param      array   $condition  The condition
     * @param      string  $format     The format
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function Warning(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-warning", $condition, $format);
        return $this;
    }

    /**
     * Adds the class table-danger if condition is true
     *
     * @param      array   $condition  The condition
     * @param      string  $format     The format
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function Danger(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-danger", $condition, $format);
        return $this;
    }

    /**
     * Adds the class table-info if condition is true
     *
     * @param      array   $condition  The condition
     * @param      string  $format     The format
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function Info(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-info", $condition, $format);
        return $this;
    }

    /**
     * Adds the class table-light if condition is true
     *
     * @param      array   $condition  The condition
     * @param      string  $format     The format
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function Light(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-light", $condition, $format);
        return $this;
    }

    /**
     * Adds the class table-dark if condition is true
     *
     * @param      array   $condition  The condition
     * @param      string  $format     The format
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function Dark(array $condition = [], string $format = null): self
    {
        $this->addFilteredClass("table-dark", $condition, $format);
        return $this;
    }

    /**
     * Gets the filtered classes.
     *
     * @param      <type>  $row    The row
     *
     * @return     array   The filtered classes.
     */
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
            if (in_array($this->formattype, ['int','number','float','decimal'])) {
                $field = strval($field);
                $value = strval($value);
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
                    # do nothing
                    break;
            }
        }

        return $classes;
    }

}
