<?php

namespace Rakoitde\Ci4bs4table;

use CodeIgniter\HTTP\IncomingRequest;

/**
 * This class describes a table.
 */
class Table
{

    public string $id = "table";

    public string $size = "sm";

    public string $caption;

    private array $captions;

    protected thead $thead;

    protected tbody $tbody;

    protected tfoot $tfoot;

    private array $classes;

    protected string $uri;

    protected array $values;

    protected IncomingRequest $request;

    protected $model;

    protected $fields;

    protected array $_fields;

    protected $entities;

    protected array $options;

    protected int $perpage = 15;

    protected $config;

    protected array $columns;

    protected bool $sortable;

    protected bool $filterable;

    protected array $filtervalues;

    protected bool $paginate;


    /**
     * { function_description }
     *
     * @param      string  $id     The identifier
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function Id(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * { function_description }
     *
     * @param      string  $caption  The caption
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function Caption(string $caption = ""): self
    {
        $this->caption = $caption;
        $this->captions[] = $caption;
        return $this;
    }

    /**
     * Adds a class.
     *
     * @param      string  $class  The class
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function addClass(string $class): self
    {
        $classes = explode(" ", $class);
        foreach ($classes as $class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    /**
     * Gets the classes.
     *
     * @return     string  The classes.
     */
    public function getClasses(): string
    {
        return isset($this->classes) ? implode(" ", $this->classes) : "";
    }

    /**
     * { function_description }
     *
     * @param      string  $uri    The uri
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function Uri(string $uri): self
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * Gets the uri.
     *
     * @return     string  The uri.
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * { function_description }
     *
     * @param      <type>  $values  The values
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function Values($values): self
    {
        $this->values = $values;
        return $this;
    }

    /**
     * { function_description }
     *
     * @return     self  ( description_of_the_return_value )
     */
    public function Small(): self
    {
        $this->addClass("table-sm");
        return $this;
    }

    /**
     * { function_description }
     *
     * @return     self  ( description_of_the_return_value )
     */
    public function Dark(): self
    {
        $this->addClass("table-dark");
        return $this;
    }

    /**
     * { function_description }
     *
     * @return     self  ( description_of_the_return_value )
     */
    public function Light(): self
    {
        $this->addClass("table-light");
        return $this;
    }

    /**
     * { function_description }
     *
     * @return     self  ( description_of_the_return_value )
     */
    public function Striped(): self
    {
        $this->addClass("table-striped");
        return $this;
    }

    /**
     * { function_description }
     *
     * @return     self  ( description_of_the_return_value )
     */
    public function Bordered(): self
    {
        $this->addClass("table-bordered");
        return $this;
    }

    /**
     * { function_description }
     *
     * @return     self  ( description_of_the_return_value )
     */
    public function Borderless(): self
    {
        $this->addClass("table-borderless");
        return $this;
    }

    /**
     * { function_description }
     *
     * @return     self  ( description_of_the_return_value )
     */
    public function Hover(): self
    {
        $this->addClass("table-hover");
        return $this;
    }

    public function Paginate(bool $paginate = true):self
    {
        $this->paginate = $paginate;
        return $this;
    }

    /**
     * { function_description }
     *
     * @param      array  $options  The options
     *
     * @return     self   ( description_of_the_return_value )
     */
    public function Options(array $options): self 
    {
        $this->options = $options;
        return $this;
    }

    public function addColumns() {
        foreach ($this->fields as $field) {
            $this->addColumn($field);
        }
    }

    /**
     * Adds a column.
     *
     * @param      string  $fieldname  The fieldname
     *
     * @return     Column  ( description_of_the_return_value )
     */
    public function addColumn(string $fieldname = '')
    {
        // $thead = $this->Thead();
        // $thead->Th($fieldname);

        // $tbody = $this->Tbody();
        // $tbody->Td($fieldname);

        $column = new Column($fieldname);

        if (isset($this->_fields[$fieldname])) {



            $column->Field($this->_fields[$fieldname]);
            $column->Sort($this->sortable);
            if ($this->filterable) { $column->Filter(null ,$this->options ?? []); }
            $column->Filtervalue( $this->filtervalues[$this->config->filtervar][$fieldname] ?? null );
        }


        $this->columns[] = $column;

        return $column;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function Column(string $fieldname): Column
    {
        foreach ($this->columns as $column) {
            if ($column->fieldname==$fieldname) {
                return $column;
            }
        }
        return new Column;
    }

    public function removeColumn(string $fieldname): self
    {
        foreach ($this->columns as $key => $column) {
            if ($column->fieldname==$fieldname) {
                unset($this->columns[$key]);

            }
        }
        return $this;
    }

    /**
     * Mark all colums as sortable
     *
     * @param      bool  $sortable  The sortable
     *
     * @return     self
     */
    public function Sort(bool $sortable = true): self 
    {
        $this->sortable = $sortable;
        return $this;
    }

    /**
     * Mark all colums as filterable
     *
     * @param      bool  $filterable  The filterable
     *
     * @return     self
     */
    public function Filter(bool $filterable = true): self 
    {
        $this->filterable = $filterable;
        return $this;
    }

    /**
     * Gets the pager links.
     *
     * @return     <type>  The pager links.
     */
    public function getPagerLinks()
    {
        $this->getEntities();
        return $this->model->pager !== null ? $this->model->pager->links() : '';
    }

    /**
     * Parse table as html
     *
     * @return     string  ( returns the table html code )
     */
    public function parse(): string 
    {

        $t = $this->template;
        $attributes = [
            'id'    => $this->id,
            'class' => $this->getClasses(),
        ];

        if (!isset($this->columns) || count($this->columns)===0) { $this->addColumns(); }

        // Table
        $html = sprintf($t->table_open, stringify_attributes($attributes));
        // Caption
        if (isset($this->captions)) {
            foreach ($this->captions as $caption) {
                $html.= sprintf($t->caption, $caption);
            }
        }
        // Form
        $html.= sprintf($t->table_form, $this->id, $this->uri);
        // Thead
        $html.= sprintf($t->thead_open);
        $html.= $this->parseTHead();
        $html.= $t->thead_close;
        // Tfoot
        $html.= sprintf($t->tfoot_open);
        $html.= $t->tfoot_close;
        // TBody
        $html.= sprintf($t->tbody_open);
        $html.= $this->parseTBody();
        $html.= $t->tbody_close;

        $html.= $t->table_close;
        return $html;

    }

    /**
     * { function_description }
     *
     * @return     string  ( returns the thead html code )
     */
    private function parseTHead(): string 
    {
        $t = $this->template;

        $html = sprintf($t->heading_row_start, '');
        foreach ($this->getColumns() as $column)
        {
            $fieldname = $column->fieldname;

            $attributes = [
                'class' => $column->getClasses("thead"),
            ];
            $html.= sprintf($t->heading_cell_start, stringify_attributes($attributes));

            $segment = $this->uri.'?'.$this->config->sortvar.'['.$fieldname.']='.$column->getNextDirection();

            $html.= $column->isSortable() ? sprintf($t->heading_cell_sorted_start, $segment) : '';
            $html.= $column->getLabel();
            $html.= $column->isSortable() ? sprintf($t->heading_cell_sorted_end) : '';
            $html.= $column->isSortable() ? sprintf($t->heading_cell_sorted_icon[$column->getDirection()], $segment) : '';
            if ($column->isFilterable()) {


                $html.= $column->getFiltervalue() ? sprintf($t->heading_cell_filter_dropdown_icon_filtered) :sprintf($t->heading_cell_filter_dropdown_icon_notfiltered);
                $html.=sprintf($t->heading_cell_filter_dropdown_start);

                // select filter template
                switch ($column->getFiltertype()) {
                    case 'text':     $template = $this->parseFilterText(); break;
                    case 'checkbox': $template = $this->parseFilterCheckbox($column); break;
                    default:         $template = $this->parseFilterText(); break;
                }
                #$template = $t->heading_cell_filter_text;
                $template = str_replace("{id}", $this->id, $template);
                $template = str_replace("{filtervar}", $this->config->filtervar, $template);
                $template = str_replace("{fieldname}", $column->fieldname, $template);
                $value=$column->getFiltervalue();
                $html.= is_string($value) ? str_replace('{value}', $value, $template) : str_replace('{value}', '', $template);

                $html.=sprintf($t->heading_cell_filter_dropdown_end);
            }
            $html.=sprintf($t->heading_cell_end);
        }
        $html.= sprintf($t->heading_row_end);

        return $html;
    }

    /**
     * { function_description }
     *
     * @return     string  ( description_of_the_return_value )
     */
    private function parseFilterText(): string 
    {
        return $this->template->heading_cell_filter_text;
    }

    private function parseFilterCheckbox($column): string
    {
        $t = $this->template;
        $template = $t->heading_cell_filter_checkbox_start;
        $options = $column->getOptions();
        $option = $column->getOption($column->fieldname);

        if (count($options)===0) { 
            $column->Options([$column->fieldname => $this->config->options['checkbox']]); 
            $options = $column->getOptions();
        }


        if ($options) {
            foreach ($options[$column->fieldname] as $key => $value) {
                $checkbox = str_replace("{key}"    , $key,   $t->heading_cell_filter_checkbox);
                $checkbox = str_replace("{value}"  , $value, $checkbox);
                $checkbox = str_replace("{checked}", $column->getFiltervalue($key) ? "checked" : "", $checkbox);
                $template.= $checkbox;
            }
        }
        $template.= $t->heading_cell_filter_checkbox_end;

        return $template;
    } 

    /**
     * { function_description }
     *
     * @return     string  ( returns the tbody html code )
     */
    private function parseTBody(): string 
    {
        $t = $this->template;
        $html = '';

        #d($this->getEntities());
        foreach ($this->getEntities() as $row)
        {
            $html.= sprintf($t->row_start, '');
            foreach ($this->getColumns() as $column)
            {

                $column->Options($this->options ?? []);
                $fieldname = $column->fieldname;

                $attributes = [
                    'class' => $column->getClasses("tbody").' '.implode(' ', $column->getFilteredClasses($row)),
                    'test'  => implode(" ", $column->getFilteredClasses($row)),
                ];

                $html.= sprintf($t->cell_start, stringify_attributes($attributes));

                $html.= $column->getValue($row);
                $html.= sprintf($t->cell_end);
            }
            $html.= sprintf($t->row_end);
        }

        return $html;
    }

    public function getFormID(): string
    {
        return "form_".$this->id;
    }

    public function getPerPageSelected(int $rows): string 
    {
        if (!isset($this->filtervalues[$this->config->perpagevar])) { return ''; }
        return $rows==$this->filtervalues[$this->config->perpagevar] ? "selected" : '';
    }

    public function getPerPageSelect(): string
    {
        $t = $this->template;
        $start = str_replace('{formid}', $this->getFormID(),  $t->perpage_select_start);
        $start = str_replace('{perpagevar}', $this->config->perpagevar,  $start);
        $html = $start;
        foreach ($this->config->perpage_sizes as $size) {
            $option = str_replace('{value}', $size, $t->perpage_select_option);
            $option = str_replace('{selected}', $this->getPerPageSelected((string)$size), $option);
            #$option = str_replace(search, replace, subject)
            $html.= $option;
        }
        $html.= $t->perpage_select_end;

        return $html;
    }

    public function getSearchField(): string
    {
        $t = $this->template;
        $field = str_replace('{searchvar}', $this->config->searchvar, $t->search_field);
        $field = str_replace('{value}', $this->getSearch(), $field);
        $field = str_replace('{formid}', $this->getFormID(), $field);

        return $field;
    }

    public function getSearchSubmitButton(): string
    {
        $t = $this->template;
        $field = str_replace('{formid}', $this->getFormID(), $t->submit_button );

        return $field;
    }

    public function getSearchResetButton(): string
    {
        $t = $this->template;
        $field = str_replace('{uri}', $this->getUri(), $t->reset_button );

        return $field;
    }

    public function getSearchInlineForm(): string
    {
        $t = $this->template;
        $form = str_replace('{pagerlinks}', $this->getPagerLinks(), $t->inline_form_start);
        $elements = str_replace('{perpageselect}', $this->getPerPageSelect(), $t->inline_form_elements);
        $elements = str_replace('{searchfield}', $this->getSearchField(), $elements);
        $elements = str_replace('{submitbutton}', $this->getSearchSubmitButton(), $elements);
        $elements = str_replace('{resetbutton}', $this->getSearchResetButton(), $elements);
        $form.= $elements;
        $form.= $t->inline_form_end;

        return $form;
    }

    public function pagerFrom(): string
    {
        $pager = $this->model->pager;
        $pagerFrom = min(($pager->getCurrentPage()*$pager->getPerPage())-$pager->getPerPage()+1, $pager->getTotal());
        return $pagerFrom;
    } 

    public function pagerTo(): string
    {
        $pager = $this->model->pager;
        $pagerTo = min($pager->getCurrentPage()*$pager->getPerPage(), $pager->getTotal());
        return $pagerTo;
    }

    public function pagerTotal(): string
    {
        return $this->model->pager->getTotal();
    }

    public function addPagerCaption()
    {
        $caption = str_replace('{from}' , $this->pagerFrom() , $this->template->pager_caption);
        $caption = str_replace('{to}'   , $this->pagerTo()   , $caption);
        $caption = str_replace('{total}', $this->pagerTotal(), $caption);
        $this->Caption($caption);
    }

    /**
     * Adds a request.
     *
     * @param      \CodeIgniter\HTTP\IncomingRequest  $request  The request
     */
    public function addRequest() {


        if ($this->request->getMethod()=='post') {
            $values = $this->request->getPost();
        } elseif ($this->request->getMethod()=='get') {
            $values = $this->request->getGet();
        }
        $keys = [$this->config->sortvar, $this->config->filtervar];
        foreach ($keys as $key) {
            if (isset($values[$key])) {
                foreach ($values[$key] as $field => $value) {
                    if ($value=="") { unset($values[$key][$field]); }
                }
            }
        }

        $this->perpage = $values[$this->config->perpagevar] ?? $this->config->perpage;

        $this->Values($values);
    }

    /**
     * Adds a model.
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function addModel( )
    {

        $fields = $this->model->db->getFieldData($this->model->table);

        foreach ($fields as $field) {
            $this->fields[] = $field->name;
            $this->_fields[$field->name] = new Field($field);
        }

        return $this->model;
    }

    /**
     * Gets the model.
     *
     * @return     <type>  The model.
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Gets the entities.
     *
     * @return     <type>  The entities.
     */
    public function getEntities()
    {

        $filters  = $this->getFilter();

        if (count($filters)>0) {
            $this->model->groupStart();
            foreach ($this->getFilter() as $field => $filter) {

                if ($filter=="") { continue; }

                $fieldtype=$this->_fields[$field]->fieldtype;

                // Date
                if (in_array($fieldtype, ['int','decimal','float','currency','number','date'])) {

                    $datefilter = $filters[$field];
                    $islaterorequal   = substr($datefilter, 0, 2)==">=" ?? false;
                    $isearlierorequal = substr($datefilter, 0, 2)=="<=" ?? false;
                    $datefilter = $islaterorequal || $isearlierorequal ? substr($datefilter, 2) : $datefilter;

                    $islater   = substr($datefilter, 0, 1)==">" ?? false;
                    $isearlier = substr($datefilter, 0, 1)=="<" ?? false;
                    $datefilter = $isearlier || $islater ? substr($datefilter, 1) : $datefilter;

                    $d = implode("-",array_reverse(explode(".", $datefilter)));

                    if ($isearlier) {
                        $this->model->Where($field." <", $d);
                    }
                    if ($islater) {
                        $this->model->Where($field." >", $d);
                    }
                    if ($isearlierorequal) {
                        $this->model->Where($field." <=", $d);
                    }
                    if ($islaterorequal) {
                        $this->model->Where($field." >=", $d);
                    }
                    if (!($islater || $isearlier || $isearlierorequal || $islaterorequal)) {
                        $side="";
                        if (mb_strpos($filter, "*") !== false) {
                            $side = "none";
                            $datefilter = str_replace("*", "%", $datefilter);
                        }
                        $this->model->Like($field, $datefilter, $side);
                    }

                }

                // integer, decimal, float, currency
                if ( in_array($fieldtype, ['int','decimal','float','currency','number']) ) {

                }


                // string
                if ( is_string($filter) && !in_array($fieldtype, ['int','decimal','float','currency','number','date']) )
                {
                    $side = "";
                    if (mb_strpos($filter, "*") !== false) {
                        $filter = str_replace("*", "%", $filter);
                        $side = "none";
                    }
                    $this->model->Like($field, $filter, $side);
                }

                // select
                if (is_array($filter) && !in_array($fieldtype, ['int','decimal','float','currency','number','date'])) {
                    $this->model->groupStart();
                    foreach ($filter as $key => $value) {
                        $this->model->orWhere($field, $key);
                    }
                    $this->model->groupEnd();
                }

            }
            $this->model->groupEnd();
        }

        // Search
        $search   = $this->getSearch();

        if ($search>"") {
            $this->model->groupStart();
            foreach ($this->fields as $field) {
                $this->model->orLike($field, $search);
            }
            $this->model->groupEnd();
        } 

        // Sort
        $sortings = $this->getSort();
        foreach ($sortings as $key => $value) {
            $this->model->orderBy($key, $value);
        }

        // paginate or not
        if ($this->paginate) {
            $this->entities = $this->model->paginate( $this->perpage );
            $this->addPagerCaption();
        } else {
            $this->entities = $this->model->findAll();
        }


        return $this->entities;
    }

    /**
     * Gets the sort.
     *
     * @return     array  The sort.
     */
    public function getSort(): array
    {
        $sortvar = $this->config->sortvar;
        if (isset($this->values[$sortvar])) { return $this->values[$sortvar]; }
        return [];
    }

    /**
     * Gets the filter.
     *
     * @return     array  The filter.
     */
    public function getFilter(): array
    {
        $filtervar = $this->config->filtervar;

        if (isset($this->filtervalues[$filtervar])) { 


            /**
             * { var_description }
             *
             * @var        callable
             */
            $filters = array_filter($this->filtervalues[$filtervar], function($k) {
                return $k != '';
            });
            return $filters;

        }
        return [];
    }

    /**
     * Gets the search.
     *
     * @return     string  The search.
     */
    public function getSearch(): string
    {

        return $this->filtervalues[$this->config->searchvar] ?? '';

        $searchvar = $this->config->searchvar;
        if (isset($this->values[$searchvar])) { return $this->values[$searchvar]; }
        return "";
    }


    /**
     * Creates filtervars from get, post and session
     */
    private function createFiltervars()
    {

        $session = session();

        // reset filter if no get request send
        if (count($this->request->getGet())===0) {
            $vars = [
                $this->config->sortvar,
                $this->config->filtervar,
                $this->config->searchvar,
                $this->config->perpagevar,
            ];
            foreach ($vars as $var) {
                unset($_SESSION[$var]);
            }
        }

        // remove filtervar from session
        unset($_SESSION[$this->config->filtervar]); 
        
        // Sortvar, Filtervar
        $vars = [
            $this->config->sortvar,
            $this->config->filtervar,
        ];

        foreach ($vars as $var) {
            if (session($var)) {
                $filtervar[$var] = array_filter(session($var), fn($value) => !is_null($value) && $value !== '');
            }

            foreach ((array)$this->request->getGet($var) as $key => $value) {
                if ($value==NULL && isset($filtervar)) { unset($filtervar[$var][$key]); }
                if ($value!=NULL) { $filtervar[$var][$key]=$value; }
            }

            if (isset($filtervar[$var]) && count($filtervar[$var])==0) { 
                unset($filtervar[$var]); 
                unset($_SESSION[$var]); 
            }
        }

        // Search
        $filtervar[$this->config->searchvar] = $this->request->getGet($this->config->searchvar)!==NULL ? $this->request->getGet($this->config->searchvar) : session($this->config->searchvar);
        if ($filtervar[$this->config->searchvar]==NULL) { 
            unset($filtervar[$this->config->searchvar]); 
            unset($_SESSION[$this->config->searchvar]);
        }

        // Sites per page
        $filtervar[$this->config->perpagevar] = $this->request->getGet($this->config->perpagevar)!==NULL ? $this->request->getGet($this->config->perpagevar) : session($this->config->perpagevar);

        $filtervar[$this->config->perpagevar] = $this->request->getGet($this->config->perpagevar) ?? session($this->config->perpagevar) ?? $this->config->perpage;


        if ($filtervar[$this->config->perpagevar]==NULL) { 
            unset($filtervar[$this->config->perpagevar]); 
            unset($_SESSION[$this->config->perpagevar]);
        }

        $this->filtervalues = $filtervar;

        $session->set($filtervar);

    }

    /**
     * Constructs a new instance.
     *
     * @param      string  $modelname  The modelname
     */
    public function __construct($model) {

        $this->config = new Config\Config();

        if (is_string($model)) { 
            $this->model = model($model); 
        } elseif (is_object($model)) {
            $this->model = $model;
        }
        
        $this->id = $this->model->table;

        $this->uri = current_url(true)->getPath();

        $this->paginate = $this->config->paginate;

        $this->addClass("table");

        // set defaults
        $this->sortable = $this->config->sortable;
        $this->filterable = $this->config->filterable;
        if ($this->config->small)   { $this->Small(); }
        if ($this->config->striped) { $this->Striped(); }
        if ($this->config->hover)   { $this->Hover(); }

        #$this->template = config("Rakoitde\ci4bs4table\Config\\".$this->config->templatename); 
        $this->template = config($this->config->templatename); 

        $this->perpage = $this->config->perpage;
        $this->addModel( );
        $this->request = \Config\Services::request();

        $this->createFiltervars();

        $this->addRequest();

    }

}


