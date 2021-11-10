<?php

namespace Rakoitde\Ci4bs4table;

/**
 * This class describes a column.
 */
class Column
{
    use ClassFilterTrait;

    /**
     * the ci4table config
     *
     * @var object
     */
    protected $config;

    /**
     * fieldname
     *
     * @var
     */
    public string $fieldname;

    /**
     * Field instance
     */
    protected Field $field;

    /**
     * label
     */
    protected string $label;

    /**
     * sortable
     */
    protected bool $sortable;

    /**
     * sort direction
     */
    protected string $sortdirection;

    /**
     * next sort direction
     */
    protected string $sortnextdirection;

    /**
     * sort direction icon
     */
    protected string $sortdirectionicon;

    /**
     * filterable
     */
    protected bool $filterable;

    /**
     * type of filter
     */
    protected string $filtertype;

    /**
     * filter options
     */
    protected array $filteroptions;

    /**
     * format type
     */
    protected string $formattype = 'text';

    /**
     * format string
     */
    protected string $format;

    /**
     * options
     */
    protected array $options;

    /**
     * filter value
     *
     * @var ???
     */
    protected $filtervalue;

    /**
     * html with conditions
     */
    protected array $htmlcondition;

    /**
     * sets the focus for changes to thead, tbody or tfoot.
     */
    protected string $tfocus = 'tbody';

    /**
     * added classes as array
     */
    private array $classes;

    /**
     * field instance
     *
     * @param Field $field The field
     */
    public function Field(Field $field): self
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Custom Label
     *
     * @param string $label The label
     */
    public function Label(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Gets the label.
     *
     * @return string The label.
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Mark column as sortable
     *
     * @param bool   $sortable  The sortable
     * @param string $direction The direction
     */
    public function Sort(bool $sortable = true, string $direction = ''): self
    {
        $session     = session();
        $sessiondata = $session->get($this->config->sortvar);

        $this->sortable = $sortable;
        $getsort        = $this->request->getGet($this->config->sortvar);

        $direction = $getsort[$this->fieldname] ?? $sessiondata[$this->fieldname] ?? $direction;

        $sessiondata[$this->fieldname] = $direction;

        //$session->markAsTempdata($sessiondata, 30);
        $session->set([$this->config->sortvar => $sessiondata]);

        $this->sortdirection = in_array($direction, ['asc', 'desc', ''], true) ? $direction : '';

        $dirs                    = ['' => 'asc', 'asc' => 'desc', 'desc' => ''];
        $this->sortnextdirection = $dirs[$direction];

        $this->sortdirectionicon = $this->template->heading_cell_sorted_icon[$direction];

        return $this;
    }

    /**
     * Determines if the column is sortable.
     *
     * @return bool True if sortable, False otherwise.
     */
    public function isSortable(): bool
    {
        return $this->sortable ?? false;
    }

    /**
     * Gets the direction.
     *
     * @return string The direction.
     */
    public function getDirection(): string
    {
        return $this->sortdirection ?? '';
    }

    /**
     * Gets the next direction.
     *
     * @return string The next direction.
     */
    public function getNextDirection(): string
    {
        return $this->sortnextdirection ?? '';
    }

    /**
     * Mark column as filterable
     *
     * @param string $type    The type
     * @param array  $options The options
     */
    public function Filter($type = null, array $options = []): self
    {
        $this->filterable = true;

        if ($type === null && $this->field->formfieldtype === 'text') {
            $type = 'text';
        }
        if ($type === null && $this->field->formfieldtype === 'date') {
            $type = 'date';
        }
        if ($type === null && $this->field->fieldtype === 'tinyint' && $this->field->maxlength === 1) {
            $type = 'checkbox';
        }
        if ($type === null && $this->field->fieldtype === 'int' && $this->field->precision === 0) {
            $type = 'int';
        }
        if ($type === null && $this->field->fieldtype === 'decimal' && $this->field->precision === 0) {
            $type = 'int';
        }
        //if ($type==null && $this->field->fieldtype    =="decimal" && $this->field->precision==2)  { $type="currency"; }
        if ($type === null && $this->field->fieldtype === 'decimal') {
            $type = 'decimal';
        }
        if ($type === null && $this->field->fieldtype === 'float') {
            $type = 'float';
        }

        if (in_array($this->fieldname, ['currency', 'brutto', 'netto', 'preis', 'gesamt'], true)) {
            $type = 'currency';
        }

        $this->filtertype = $type;
        $this->formattype = $type;
        $this->format     = $this->config->format[$type] ?? '';

        if (in_array($type, ['int', 'decimal', 'float', 'currency'], true)) {
            $this->Right();
        }

        if (in_array($type, ['checkbox'], true)) {
            $this->Center();
        }

        if ($type === 'checkbox'
            && ! isset($options[$this->fieldname])
            && isset($config->options[$this->fieldname])) {
            $options[$this->fieldname] = $config->options[$this->fieldname];
            $this->Center();
        }

        $this->filteroptions = $options;
        $this->options       = $options;

        return $this;
    }

    /**
     * Determines if the column is filterable.
     *
     * @return bool True if filterable, False otherwise.
     */
    public function isFilterable(): bool
    {
        return $this->filterable ?? false;
    }

    /**
     * sets the filtervalues
     *
     * @param      <type>  $filtervalue  The filtervalue
     *
     * @return self ( description_of_the_return_value )
     */
    public function Filtervalue($filtervalue): self
    {
        $this->filtervalue = $filtervalue;

        return $this;
    }

    /**
     * returns the filtervalues
     *
     * @param string $key The key
     *
     * @return  <type>  The filtervalue.
     */
    public function getFiltervalue(?string $key = null)
    {
        if ($key !== null && is_array($this->filtervalue)) {
            return $this->filtervalue[$key] ?? '';
        }

        return $this->filtervalue ?? '';
    }

    /**
     * returns the filter type
     *
     * @return string The filtertype.
     */
    public function getFiltertype(): string
    {
        return $this->filtertype ?? '';
    }

    /**
     * sets the format type end format string
     *
     * @param string $type   The type
     * @param string $format The format
     *
     * @return self ( description_of_the_return_value )
     */
    public function Format(string $type, string $format = ''): self
    {
        $this->formattype = $type;
        $this->format     = $format;

        return $this;
    }

    /**
     * sets the options
     *
     * @param array $options The options
     *
     * @return self ( description_of_the_return_value )
     */
    public function Options(array $options): self
    {
        $this->options       = $options;
        $this->filteroptions = $options;

        return $this;
    }

    /**
     * get the options
     *
     * @return array The options.
     */
    public function getOptions(): array
    {
        return $this->options ?? [];
    }

    /**
     * get a option by key
     *
     * @param string $text The text
     *
     * @return string The option.
     */
    public function getOption(string $text)
    {
        if ($text === null) {
            return '';
        }

        return $this->options[$text] ?? $text;
    }

    /**
     * Sets the Focus on Thead
     *
     * @return self ( description_of_the_return_value )
     */
    public function Thead(): self
    {
        $this->tfocus = 'thead';

        return $this;
    }

    /**
     * Sets the Focus on Tbody
     *
     * @return self ( description_of_the_return_value )
     */
    public function Tbody(): self
    {
        $this->tfocus = 'tbody';

        return $this;
    }

    /**
     * Adds a class.
     *
     * @param string $class The class
     * @param      <type>  $tfocus  The tfocus
     *
     * @return self ( description_of_the_return_value )
     */
    public function addClass(string $class, $tfocus = null): self
    {
        $classes = explode(' ', $class);
        $tfocus  = $tfocus ?? $this->tfocus;
        $tfocus  = is_string($tfocus) ? (array) $tfocus : $tfocus;

        foreach ($classes as $class) {
            foreach ($tfocus as $t) {
                $this->classes[$t][] = $class;
            }
        }

        return $this;
    }

    /**
     * Adds classes.
     *
     * @param array $classes The classes
     * @param      <type>  $tfocus   The tfocus
     */
    public function addClasses(array $classes, $tfocus = null)
    {
        foreach ($classes as $class) {
            $this->addClass($class, $tfocus);
        }
    }

    /**
     * Gets the classes as string
     *
     * @param string $tfocus The tfocus
     *
     * @return string The classes.
     */
    public function getClasses($tfocus = 'tbody'): string
    {
        return isset($this->classes[$tfocus]) ? implode(' ', $this->classes[$tfocus]) : '';
    }

    /**
     * Center
     * adds text-center class on focus
     *
     * @param array $tfocus The tfocus
     *
     * @return self ( description_of_the_return_value )
     */
    public function Center($tfocus = ['tbody', 'thead', 'tfoot']): self
    {
        $this->addClass('text-center', $tfocus);

        return $this;
    }

    /**
     * Right
     * Adds text-right class on focus
     *
     * @param array $tfocus The tfocus
     *
     * @return self ( description_of_the_return_value )
     */
    public function Right($tfocus = ['tbody', 'thead', 'tfoot']): self
    {
        $this->addClass('text-right', $tfocus);

        return $this;
    }

    /**
     * Adds a html string with conditions
     *
     * @param string $html       The html
     * @param array  $conditions The condition as array ['{field}','==','0']
     * @param array  $convert    The convert
     *
     * @return self ( description_of_the_return_value )
     */
    public function Html(string $html, array $conditions = []): self
    {
        $htmlcondition             = new \stdClass();
        $htmlcondition->html       = $html;
        $htmlcondition->conditions = $conditions;
        $this->htmlcondition[]     = $htmlcondition;

        return $this;
    }

    /**
     * Convert
     * ??????
     *
     * @param      <type>  $oldrow   The oldrow
     * @param      <type>  $convert  The convert
     *
     * @return array ( description_of_the_return_value )
     */
    public function ___convert($oldrow, $convert): array
    {
        $row = [];

        foreach ($oldrow as $key => $value) {
            if (isset($convert[$key])) {
                $value = $convert[$key][$value] ?? $value;
            }
            $row[$key] = $value;
        }

        return $row;
    }

    /**
     * return the current row parsed with given options as array
     *
     * @param object $rowobject The rowobject
     *
     * @return array ( parsed row as array )
     */
    private function parseRowWithOptions(object $rowobject): array
    {
        $row     = $rowobject->toArray();
        $options = $this->options;
        if (! isset($this->options)) {
            $this->options = $this->config->options;
            $this->addOptions($this->options);

            return $row;
        }

        foreach ($row as $field => $value) {
            $row[$field] = $options[$field][$value] ?? $value ?? '';
        }

        return $row;
    }

    /**
     * returns the formated value
     *
     * @param      <type>  $value  The value
     *
     * @return  <type>  ( description_of_the_return_value )
     */
    private function formatValue($value)
    {
        $value = $this->formattype === 'date' ? date_format(date_create($value), $this->format) : $value;
        $value = $this->formattype === 'datetime' ? date_format(date_create($value), $this->format) : $value;
        $value = $this->formattype === 'currency' ? number_to_currency($value, $this->format) : $value;
        $value = $this->formattype === 'decimal' ? number_format($value, $this->format, ',', '.') : $value;

        return $this->formattype === 'float' ? number_format($value, $this->format, ',', '.') : $value;
    }

    /**
     * Gets the value.
     *
     * @param      <type>  $row    The row
     *
     * @return string The value.
     */
    public function getValue($row): string
    {
        $parsedRows = $this->parseRowWithOptions($row);
        $fieldname  = $this->fieldname;

        if (! isset($this->htmlcondition)) {
            return $this->formatValue($parsedRows[$fieldname]); // $this->text;
        }

        $html = '';

        foreach ($this->htmlcondition as $h) {
            $value = $this->parser->setData($parsedRows)->renderString($h->html);
            $value = $this->formatValue($value);

            if (count($h->conditions) === 0) {
                $html .= $value;

                continue;
            }

            [$operand_a, $operator, $operand_b] = $h->conditions;

            $op_a = $this->parser->setData($row->toArray())->renderString($operand_a);
            $op_b = $this->parser->setData($row->toArray())->renderString($operand_b);

            switch ($operator) {
                case '==':
                    $html .= ($op_a === $op_b) ? $value : ''; break;

                case '!=':
                    $html .= ($op_a !== $op_b) ? $value : ''; break;

                case '>=':
                    $html .= ($op_a >= $op_b) ? $value : ''; break;

                case '<=':
                    $html .= ($op_a <= $op_b) ? $value : ''; break;

                case '>':
                    $html .= ($op_a > $op_b) ? $value : ''; break;

                case '<':
                    $html .= ($op_a < $op_b) ? $value : ''; break;

                case 'in':
                    $html .= (in_array($op_a, explode(',', $filter->op_b), true)) ? $value : ''; break;

                case '!in':
                    $html .= (! in_array($op_a, explode(',', $filter->op_b), true)) ? $value : ''; break;

                case 'between':
                    $v = explode(',', $filter->op_b);
                    $html .= ($op_a >= $v[0] && $op_a <= $v[1]) ? $value : ''; break;

                default:
                    $html .= ''; break;
            }
        }

        return $html;
    }

    /**
     * Adds a icon string with conditions
     *
     * @param string $icon      The icon
     * @param array  $condition The condition
     * @param string $class     The class
     *
     * @return self ( description_of_the_return_value )
     */
    public function Icon(string $icon, array $condition = [], string $class = ''): self
    {
        $html = str_replace('{icon}', $icon, $this->template->icontag);
        $html = str_replace('{class}', " {$class}", $html);

        $this->Html($html, $condition);

        return $this;
    }

    /**
     * Constructs a new instance.
     *
     * @param string $columnname The columnname
     */
    public function __construct(string $columnname = '')
    {
        $this->fieldname = $columnname;

        $this->Label(ucfirst($columnname));

        $this->config   = new \Rakoitde\ci4bs4table\Config\Config();
        $this->template = config('Rakoitde\\ci4bs4table\\Config\\' . $this->config->templatename);

        $this->request = \Config\Services::request();

        $this->parser = \Config\Services::parser();
    }
}
