<?php

namespace Rakoitde\ci4bs4table;

use Config\Services;

/**
 * This class describes a column.
 */
class Column
{

    use ClassFilterTrait;

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

    protected string $formattype = 'text';

    protected string $format;

    protected array $options;

    protected $filtervalue;

    protected array $htmlcondition;

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
    public function Filter($type = null, array $options = []): self
    {

        $this->filterable = true;

        if ($type==null && $this->field->formfieldtype=="text")   { $type = "text"; }
        if ($type==null && $this->field->formfieldtype=="date")   { $type = "date"; }
        if ($type==null && $this->field->fieldtype    =="tinyint" && $this->field->maxlength==1)  { $type="checkbox"; }
        if ($type==null && $this->field->fieldtype    =="int"     && $this->field->precision==0)  { $type="int";      }
        if ($type==null && $this->field->fieldtype    =="decimal" && $this->field->precision==0)  { $type="int";      }
        #if ($type==null && $this->field->fieldtype    =="decimal" && $this->field->precision==2)  { $type="currency"; }
        if ($type==null && $this->field->fieldtype    =="decimal" )                               { $type="decimal";  }
        if ($type==null && $this->field->fieldtype    =="float" )                                 { $type="float";    }

        if (in_array($this->fieldname, ['currency','brutto','netto','preis','gesamt'])) {
            $type = "currency";
        }

        $this->filtertype = $type;
        $this->formattype = $type;
        $this->format = $this->config->format[$type] ?? '';

        if (in_array($type, ['int','decimal','float','currency'])) {
            $this->Right(); 
        }

        if (in_array($type, ['checkbox'])) {
            $this->Center();
        }

        if ($type=='checkbox' && 
            !isset($options[$this->fieldname]) &&
            isset($config->options[$this->fieldname]) ) 
        {
            $options[$this->fieldname] = $config->options[$this->fieldname];
            $this->Center();
        }

        $this->filteroptions = $options;
        $this->options = $options;

# d($this->fieldname, $this->field->formfieldtype, $this->field->maxlength, $this->field->precision, $this->filteroptions, $type);

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

    public function getFiltervalue(string $key = null)
    {

        if ($key!==null && is_array($this->filtervalue)) { return $this->filtervalue[$key] ?? ''; }

        return $this->filtervalue ?? '';
    }

    public function getFiltertype()
    {
        return $this->filtertype ?? '';
    }

    public function Format($type, string $format = ""): self
    {
        $this->formattype = $type;
        $this->format = $format;
        return $this;
    }

    public function Options(array $options): self 
    {
        $this->options = $options;
        $this->filteroptions = $options;
        return $this;
    }

    public function getOptions(): array 
    {
        return $this->options ?? [];
    }

    public function getOption($text) 
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

    public function addClasses(array $classes, $tfocus = null)
    {
        foreach ($classes as $class) {
            $this->addClass($class, $tfocus);
        }
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


    public function Html(string $html, array $conditions = [], array $convert = []): self
    {
        $htmlcondition = new \stdClass();
        $htmlcondition->html      = $html;
        $htmlcondition->conditions = $conditions;
        $htmlcondition->convert   = $convert;
        $this->htmlcondition[] = $htmlcondition;
        return $this;
    }

    public function convert($oldrow, $convert): array
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
     * @param      object        $rowobject  The rowobject
     *
     * @return     array  ( parsed row as array )
     */
    private function parseRowWithOptions(object $rowobject): array
    {
        $row = $rowobject->toArray();
        $options = $this->options;
        if (!isset($this->options)) { 
            $this->options = $this->config->options;
            $this->addOptions($this->options);
            return $row; 
        }

        foreach ($row as $field => $value) {
            $row[$field] = $options[$field][$value] ?? $value ?? '';
        }

        return $row;
    }

    private function formatValue($value) 
    {
        $value = $this->formattype=="date"     ? date_format(date_create($value), $this->format) : $value;
        $value = $this->formattype=="datetime" ? date_format(date_create($value), $this->format) : $value;
        $value = $this->formattype=="currency" ? number_to_currency($value, $this->format)       : $value;
        $value = $this->formattype=="decimal"  ? number_format($value, $this->format, ',', '.')  : $value;
        $value = $this->formattype=="float"    ? number_format($value, $this->format, ',', '.')  : $value;

        return $value;
    }

    public function getValue($row): string
    {
        $parsedRows = $this->parseRowWithOptions($row);
        $fieldname = $this->fieldname;

        if (!isset($this->htmlcondition)) { return $this->formatValue($parsedRows[$fieldname]); /* $this->text; */ }

        $html="";

        foreach ($this->htmlcondition as $h) {

            $value = $this->parser->setData($parsedRows)->renderString($h->html);
            $value = $this->formatValue($value);
// if ($fieldname=="enabled" && $row->id=="2") {
//     d([$fieldname, $h->html, $value, $row->$fieldname, $this->getOption($row->$fieldname)]);
// }

            if (count($h->conditions)===0) { 
                $html.= $value; 
                continue; 
            }

            #foreach ($h->conditions as $condition) {

                list($operand_a, $operator, $operand_b) = $h->conditions;

                $op_a = $this->parser->setData($row->toArray())->renderString($operand_a);
                $op_b = $this->parser->setData($row->toArray())->renderString($operand_b);
                switch ($operator) {
                    case '==':
                        $html.= ($op_a == $op_b) ? $value : ""; break;
                    case '!=':
                        $html.= ($op_a != $op_b) ? $value : ""; break;
                    case '>=':
                        $html.= ($op_a >= $op_b) ? $value : ""; break;
                    case '<=':
                        $html.= ($op_a <= $op_b) ? $value : ""; break;
                    case '>':
                        $html.= ($op_a > $op_b) ? $value : ""; break;
                    case '<':
                        $html.= ($op_a < $op_b) ? $value : ""; break;
                    case 'in':
                        $html.= (in_array($op_a, explode(",", $filter->op_b))) ? $value : ""; break;
                    case '!in':
                        $html.= (!in_array($op_a, explode(",", $filter->op_b))) ? $value : ""; break;
                    case 'between':
                        $v = explode(",",$filter->op_b);
                        $html.= ($op_a >= $v[0] && $op_a <= $v[1]) ? $value : ""; break;
                    default:
                        $html.= ""; break;
                }
            #}

            if (count($h->convert)>0) {
                $row2 = $this->convert($row, $h->convert);
d($h->convert);
            }
        }


        return $html;
    }

    public function Icon(string $icon, array $condition = [], string $class = ""): self
    {
        $html = str_replace("{icon}", $icon, $this->template->icontag);
        $html = str_replace("{class}", " {$class}", $html);

        $this->Html($html, $condition);

        return $this;
    }

    /**
     * Constructs a new instance.
     *
     * @param      string  $columnname  The columnname
     */
    public function __construct( string $columnname = "" ) {

        $this->fieldname = $columnname;

        $this->Label(ucfirst($columnname));

        $this->config = new \Rakoitde\ci4bs4table\Config\Config();
        $this->template = config("Rakoitde\ci4bs4table\Config\\".$this->config->templatename); 

        $this->request = \Config\Services::request();

        $this->parser = \Config\Services::parser();

    }

}
