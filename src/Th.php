<?php

namespace Rakoitde\ci4bs4table;

use Rakoitde\ci4bs4table\Filter;

class Th extends Thtd
{

    public string $tag = "th";

    public bool $sortable = false;

    public bool $filtered = false;

    public string $filtertype;

    public array $filteroptions;

    protected string $filter = "";

    public Filter $_filter;

    public string $direction; # "asc", "desc", ""

    protected string $directionicon;

    protected array $queries = [];

    protected string $nextquery = '';

    public function Sort(bool $sortable = true): self
    {
        $this->sortable = $sortable;
        $this->_fields[$this->field]->sortable = $sortable;

        $sortvar = $this->config->sortvar;
        $sortvalues = $this->values[$sortvar] ?? [];

        $direction = $sortvalues[$this->field] ?? "";
        $this->direction = in_array($direction, ["asc", "desc", ""]) ? $direction : "";

        $dirs = [""=>"asc", "asc"=>"desc", "desc"=>""];
        $this->nextdirection = $dirs[$direction];

        $dirs = [
                ''=>'', 
                'asc'=>'<i class="bi bi-sort-down-alt"></i>', 
                'desc'=>'<i class="bi bi-sort-up"></i>'
        ];
        $this->directionicon = $dirs[$direction];

        if (isset($sortvalues[$this->field])) { 
            unset($sortvalues[$this->field]); 
        }

        foreach ($sortvalues as $key => $value) {
            if ($value!="") {
                $this->queries[] = "&{$sortvar}[{$key}]={$value}";
            }
        }

        $this->nextquery = "&{$sortvar}[".$this->field."]=".$this->nextdirection;

        return $this;
    }

    public function Sortable(bool $sortable = true): self
    {
        return $this->Sort($sortable);
    }

    public function getHref(bool $withnext = true): string
    {
        $href = $this->uri."?".
                implode("", $this->queries).
                ($withnext ? $this->nextquery : '');
        return $href;
    }

    public function Filter(string $type = "text", array $options = []): Filter
    {

        $this->_fields[$this->field]->formfieldtype = $type;
        $this->_fields[$this->field]->filterable = true;
        $this->_fields[$this->field]->options = $options;
        
        $this->filtered = true;

        if (!isset($this->_filter)) {
            $this->_filter = new Filter();
        }

        $this->_filter->Field($this->field);
        $this->_filter->Type($type);
        $this->_filter->Options($options);
        $this->_filter->Values($this->values[$this->config->filtervar] ?? []);

        return $this->_filter;
    }

    public function isFiltered(): bool
    {
        $filtervar = $this->config->filtervar;
        $filtervalues = $this->values[$filtervar] ?? [];
        return isset($filtervalues[$this->field]) && $filtervalues[$this->field]>"";
    }

    private function getFilterIcon(): string
    {
        $iconclass = $this->isFiltered() ? "bi bi-funnel-fill" : "bi bi-funnel" ;
        $html ='
<i class="'.$iconclass.'" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>';
        return $html;
    }

    private function getFilterDropdown(): string 
    {
        $html='
        <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="dropdownMenuButton">
            <div class="form-group">
        ';
        $html.= $this->direction=='' ? '' : '<input type="hidden" class="form-control" name="sort['.$this->field.']" id="sort'.$this->field.'" value="'.($this->direction ?? '').'">';
        $html.= '</div>';
        $html.= $this->_filter->getFormField();
        $html.= '
            <button type="submit" class="btn"><i class="bi bi-check-lg"></i>&nbsp;&nbsp;filtern</button>
            <button type="button" class="btn" onclick="
            $(this).closest(\'.dropdown-menu\').find(\'._filter_options input:checkbox\').remove();
            $(\'#filter'.$this->field.'\').val(\'\'); 
            $(this.form).submit();
            "><i class="bi bi-x-lg"> filter löschen</i></button>
        </div>';
#d($html);
        return $html;
    }

    public function toHtml($options=[]): string
    {

        $filterqueries = $options['filterqueries'] ?? '';

        // Filter Start
        if (!isset($this->filtered) || !$this->filtered) 
        {
            return parent::toHtml();
        }

        $classes = trim($this->getClasses().' '.implode(" ", $this->getFilteredClasses($this->values)));
        $tag = $this->tag;

        $html = "\t\t\t<{$tag}".' class="'.$classes.'">';
        $html.= isset($this->sortable) && $this->sortable ? '<a class="text-reset" href="'.$this->getHref().$filterqueries.'">' : '';
        $html.= $this->text;
        $html.= $this->getHtml($this->values);
        $html.= isset($this->sortable) && $this->sortable ? ' '.$this->directionicon.'</a>' : '';

$html.= isset($this->filtered) && !isset($this->_filter) && $this->filtered ? ' '.$this->getFilterIcon().$this->getFilterHtml() : '';

        $html.= isset($this->filtered) && isset($this->_filter) && $this->filtered ? ' '.$this->getFilterIcon().$this->getFilterDropdown() : '';
        $html.="</{$tag}>".PHP_EOL;

        
        return $html;
        // Filter Stop
    }

}