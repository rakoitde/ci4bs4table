<?php

namespace Rakoitde\ci4bs4table;

use Config\Services;

/**
 * This class describes a column.
 */
class Column
{

    protected $config;

    public string $fieldname;

    protected Field $field;

    protected string $label;

    protected bool $sortable;

    protected string $sortdirection;

    protected string $sortnextdirection;

    protected string $sortdirectionicon;

    protected bool $filterable;

    protected string $filtertype;

    protected array $filteroptions; 

    protected array $options;

    protected $filtervalue;

    protected $tfocus='tbody';

    private array $classes;

    /**
     * { function_description }
     *
     * @param      Field  $field  The field
     *
     * @return     self
     */
    public function Field(Field $field): self 
    {

        $this->field = $field;

        return $this;

    }

    /**
     * Custom Label
     *
     * @param      string  $label  The label
     *
     * @return     self
     */
    public function Label(string $label): self 
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Gets the label.
     *
     * @return     string  The label.
     */
    public function getLabel(): string 
    {
        return $this->label;
    }

    /**
     * Mark column as sortable
     *
     * @param      bool    $sortable   The sortable
     * @param      string  $direction  The direction
     *
     * @return     self
     */
    public function Sort(bool $sortable = true, string $direction = ""): self
    {

        $session = session();
        $sessiondata = $session->get($this->config->sortvar);

        $this->sortable = $sortable;
        $getsort = $this->request->getGet($this->config->sortvar);

        $direction = $getsort[$this->fieldname] ?? $sessiondata[$this->fieldname] ?? $direction; 

        $sessiondata[$this->fieldname] = $direction;


        #$session->markAsTempdata($sessiondata, 30);
        $session->set([$this->config->sortvar => $sessiondata]);

        $this->sortdirection = in_array($direction, ["asc", "desc", ""]) ? $direction : "";

        $dirs = [""=>"asc", "asc"=>"desc", "desc"=>""];
        $this->sortnextdirection = $dirs[$direction];

        $this->sortdirectionicon = $this->config->directionicon[$direction];

        return $this;
    }

    /**
     * Determines if the column is sortable.
     *
     * @return     bool  True if sortable, False otherwise.
     */
    public function isSortable(): bool 
    {
        return $this->sortable ?? false;
    }

    /**
     * Gets the direction.
     *
     * @return     string  The direction.
     */
    public function getDirection(): string
    {
        return $this->sortdirection ?? '';
    }

    /**
     * Gets the next direction.
     *
     * @return     string  The next direction.
     */
    public function getNextDirection(): string
    {
        return $this->sortnextdirection ?? '';
    }

    /**
     * Mark column as filterable
     *
     * @param      string  $type     The type
     * @param      array   $options  The options
     *
     * @return     self
     */
    public function Filter($type = "text", array $options = []): self
    {
        if (!$type) { 
            $this->filterable = false;
            return $this; 
        }

        $this->filterable = true;

        $this->filtertype = $type;

        $this->filteroptions = $options;

        return $this;
    }

    /**
     * Determines if the column is filterable.
     *
     * @return     bool  True if filterable, False otherwise.
     */
    public function isFilterable(): bool 
    {
        return $this->filterable ?? false;
    }

    /**
     * { function_description }
     *
     * @param      <type>  $filtervalue  The filtervalue
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function Filtervalue($filtervalue): self 
    {
        $this->filtervalue = $filtervalue;
        return $this;
    }

    public function getFiltervalue()
    {
        return $this->filtervalue ?? '';
    }

    public function Options(array $options): self 
    {
        $this->options = $options;
        return $this;
    }

    public function getOption($text): string 
    {
        if ($text===NULL) { return ''; }
        return $this->options[$text] ?? $text;
    }

    /**
     * Sets the Focus on Thead
     *
     * @return     self  ( description_of_the_return_value )
     */
    public function Thead(): self 
    {
        $this->tfocus = 'thead';
        return $this;
    }

    /**
     * Sets the Focus on Tbody
     *
     * @return     self  ( description_of_the_return_value )
     */
    public function Tbody(): self 
    {
        $this->tfocus = 'tbody';
        return $this;
    }

    public function addClass(string $class, $tfocus = null): self
    {
        $classes = explode(" ", $class);
        $tfocus = $tfocus ?? $this->tfocus;
        $tfocus = is_string($tfocus) ? (array)$tfocus : $tfocus;

        foreach ($classes as $class) {
            foreach ($tfocus as $t) {
                $this->classes[$t][] = $class;
            }
        }
        return $this;
    }

    public function getClasses($tfocus='tbody'): string
    {
        return isset($this->classes[$tfocus]) ? implode(" ", $this->classes[$tfocus]) : "";
    }

    public function Center($tfocus=['tbody','thead','tfoot']):self 
    {
        $this->addClass("text-center", $tfocus);
        return $this;
    }

    public function Right($tfocus=['tbody','thead','tfoot']):self 
    {
        $this->addClass("text-right", $tfocus);
        return $this;
    }


    public function Html()
    {

    }

    /**
     * Constructs a new instance.
     *
     * @param      string  $columnname  The columnname
     */
    public function __construct( string $columnname = "" ) {

        $this->fieldname = $columnname;

        $this->Label($columnname);

        $this->config = new \Rakoitde\ci4bs4table\Config\Config();

        $this->request = \Config\Services::request();

    }

}
