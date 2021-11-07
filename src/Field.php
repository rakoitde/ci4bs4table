<?php

namespace Rakoitde\ci4bs4table;

class Field
{

    public int $maxlength;  # 10

    public string $name; # -> string (2) "id"

    public bool $nullable; # -> boolean false

    public bool $isprimarykey; # -> integer 1

    public string $fieldtype; # -> string (3) "int"

    public string $formfieldtype = 'text'; # text, checkbox, date, datetime

    public string $formfieldformat; # d.m.Y, d.m.Y H:i:s

    public int $precision = 0;

    public bool $sortable = false;

    public bool $filterable = false;

    public array $options;

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

    public function parseValue($value): string
    {
        return $value;
    }

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