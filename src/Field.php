<?php

namespace Rakoitde\Ci4bs4table;

/**
 * This class describes a field.
 */
class Field
{

    /**
     * max field length
     * @var int
     */
    public int $maxlength;  # 10

    /**
     * fieldname
     * @var string
     */
    public string $name; # -> string (2) "id"

    /**
     * nullable
     * @var bool
     */
    public bool $nullable; # -> boolean false

    /**
     * is primary key
     * @var bool
     */
    public bool $isprimarykey; # -> integer 1

    /**
     * field type
     * @var string
     */
    public string $fieldtype; # -> string (3) "int"

    /**
     * form field type
     * @var string
     */
    public string $formfieldtype = 'text'; # text, checkbox, date, datetime

    /**
     * form field format
     * @var string
     */
    public string $formfieldformat; # d.m.Y, d.m.Y H:i:s

    /**
     * field precision
     * @var int
     */
    public int $precision = 0;

    /**
     * sortable
     * @var bool
     */
    public bool $sortable = false;

    /**
     * filterable
     * @var bool
     */
    public bool $filterable = false;

    /**
     * options for replacements and checkbox filter
     * @var array
     */
    public array $options;

    /**
     * @todo needed? refactor?
     *
     * @param      <type>  $type   The type
     */
    private function _parseType($type)
    {
        if (in_array($type, ['int','tinyint','decimal','float'])) {
            $this->formfieldtype = 'number';
        }

        if (in_array($type, ['date','datetime'])) {
            $this->formfieldtype = $type;
            $this->formfieldformat = $this->config->format[$type];
        }

        if (in_array($type, ['decimal','float'])) {
            $this->precision = $this->config->format['decimal']; 
        }        
    }

    /**
     * Constructs a new field instance.
     *
     * @param      <type>  $field  The field
     */
    public function __construct($field) {

        $this->config = new \Rakoitde\ci4bs4table\Config\Config();

        $this->maxlength    =  is_int($field->max_length) ? $field->max_length : 0;
        $this->name         =  $field->name;
        $this->nullable     =  $field->nullable==1 ? true : false;
        $this->isprimarykey =  $field->primary_key;
        $this->fieldtype    =  $field->type;
        $this->_parseType($field->type);

    }

}