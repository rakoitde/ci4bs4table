<?php

namespace Rakoitde\ci4bs4table;

use CodeIgniter\HTTP\IncomingRequest;

/**
 * This class describes a table.
 */
class Table extends TableElement
{

    public string $id = "table";

    public string $size = "sm";

    public string $caption;

    protected thead $thead;

    protected tbody $tbody;

    protected tfoot $tfoot;

    protected IncomingRequest $request;

    protected $model;

    protected $fields;

    protected array $_fields;

    protected $entities;

    protected int $perpage = 15;

    protected $config;

    protected array $columns;

    protected bool $sortable;

    protected bool $filterable;

    protected array $filtervalues;


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
            $column->Filter($this->filterable);
            $column->Filtervalue( $this->filtervalues[$this->config->filtervar][$fieldname] ?? null );
        }


        $this->columns[] = $column;

        return $column;
    }

    public function getColumns()
    {
        return $this->columns;
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
     * { function_description }
     *
     * @return     Thead  ( description_of_the_return_value )
     */
    public function Thead(): Thead
    {
        if(!isset($this->thead)) { $this->thead = new Thead(); }
        $this->thead->Uri($this->uri);
        $this->thead->Values($this->values);
        $this->thead->_fields = $this->_fields;
        return $this->thead;
    }

    /**
     * { function_description }
     *
     * @return     Tbody  ( description_of_the_return_value )
     */
    public function Tbody(): Tbody
    {
        if(!isset($this->tbody)) { $this->tbody = new Tbody(); }
        $this->tbody->Uri($this->uri);
        $this->tbody->Values($this->values);
        $this->tbody->addEntities($this->getEntities());
        $this->tbody->_fields = $this->_fields;
        return $this->tbody;
    }

    /**
     * { function_description }
     *
     * @return     Tfoot  ( description_of_the_return_value )
     */
    public function Tfoot(): Tfoot
    {
        if(!isset($this->tfoot)) { $this->tfoot = new Tfoot(); }
        $this->tfoot->Uri($this->uri);
        $this->tfoot->Values($this->values);
        return $this->tfoot;
    }

    /**
     * Gets the pager links.
     *
     * @return     <type>  The pager links.
     */
    public function getPagerLinks()
    {

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


#d($this->config, $this->template, stringify_attributes($attributes));

        // Table
        $html = sprintf($t->table_open, stringify_attributes($attributes));
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

                #$html.=sprintf($t->heading_cell_filter_text);
                $template = $t->heading_cell_filter_text;
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
                $fieldname = $column->fieldname;

                $attributes = [
                    'class' => $column->getClasses("tbody"),
                ];
                $html.= sprintf($t->cell_start, stringify_attributes($attributes));
                $html.= $column->getOption($row->$fieldname);
                $html.= sprintf($t->cell_end);
            }
            $html.= sprintf($t->row_end);
        }

        return $html;
    }

    /**
     * Returns a html representation of the object.
     *
     * @return     string  Html representation of the object.
     */
    public function toHtml(): string
    {
        $data = [
            "pager"        => $this->model->pager,
            "tableid"      => $this->id,
            "tableclasses" => $this->getClasses(),
            "caption"      => $this->caption ?? '',
            "method"       => $this->config->method,
            "baseurl"      => $this->uri,
            "thead"        => $this->thead ?? null,
            "tbody"        => $this->tbody ?? null,
            "tfoot"        => $this->tfoot ?? null,
        ];
#d($this->thead);
#d($data);
        $html="";
#$html = view('Rakoitde\ci4bs4table\Views\Table', $data);


        $table = PHP_EOL.'<!-- Start Table: '.$this->id.' -->'.PHP_EOL;
        $table.= '<table id="' . $this->id .'" class="'.$this->getClasses().'">'.PHP_EOL;
        $table.= isset($this->caption) ? "\t<caption>".$this->caption."</caption>".PHP_EOL : "";
        if (!isset($this->caption)) {
            $pager = $this->model->pager;
            $table.= "\t<caption>Datensatz ".
            min(($pager->getCurrentPage()*$pager->getPerPage())-$pager->getPerPage()+1, $pager->getTotal())." bis ".
            min($pager->getCurrentPage()*$pager->getPerPage(), $pager->getTotal())." von ".
            $pager->getTotal()."</caption";
        }
        $table.= $this->Thead()->toHtml();
        $table.= $this->Tbody()->toHtml();
        $table.= $this->Tfoot()->toHtml();
        $table.= '</table>'.PHP_EOL;
        $table.= '<!-- End Table: '.$this->id.' -->'.PHP_EOL;
        return $html.$table;
    }

    /**
     * Returns a json representation of the object.
     *
     * @return     string  Json representation of the object.
     */
    public function toJson(): string
    {
        $json = json_encode($this);
        return $json;
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
d($values);
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
// Filter
        $filters  = $this->getFilter();
        if (count($filters)>0) {
            $this->model->groupStart();
            foreach ($this->getFilter() as $field => $filter) {
                if ($filter=="") { continue; }

                $fieldtype=$this->_fields[$field]->fieldtype;
                if ($fieldtype=='date') {

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
                        $this->model->Like($field, $d."%");
                    }

                }

                if ( is_string($filter) && $fieldtype!='date' )
                {
                    $side = "";
                    if (mb_strpos($filter, "*") !== false) {
                        $filter = str_replace("*", "%", $filter);
                        $side = "none";
                    }
                    $this->model->Like($field, $filter, $side);
                }

                if (is_array($filter)) {
                    $this->model->groupStart();
                    foreach ($filter as $key => $value) {
                        $this->model->OrLike($field, $key, $value);
                    }
                    $this->model->groupEnd();
                }

            }
            $this->model->groupEnd();
        }

// Search
        $search   = $this->getSearch();
        if ($search>"") {
            foreach ($this->fields as $field) {
                $this->model->orLike($field, $search);
            }
        } 

// Sort
        $sortings = $this->getSort();
        foreach ($sortings as $key => $value) {
            $this->model->orderBy($key, $value);
        }

        $this->entities = $this->model->paginate( $this->perpage );
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

        if (isset($this->values[$filtervar])) { 


            /**
             * { var_description }
             *
             * @var        callable
             */
            $filters = array_filter($this->values[$filtervar], function($k) {
                return $k != '';
            });
            return $filters;

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
        if ($filtervar[$this->config->perpagevar]==NULL) { 
            unset($filtervar[$this->config->perpagevar]); 
            unset($_SESSION[$this->config->perpagevar]);
        }

        $this->filtervalues = $filtervar;

        d($filtervar, $this->request->getGet($this->config->searchvar) ,session($this->config->searchvar));

        $session = session();
        $session->set($filtervar);

        d($_SESSION);

    }

    /**
     * Constructs a new instance.
     *
     * @param      string  $modelname  The modelname
     */
    public function __construct(string $modelname = null) {

        $this->config = new \Rakoitde\ci4bs4table\Config\Config();

        if (isset($modelname)) { 
            $this->model = model($modelname); 
            $this->id = $this->model->table;
        }

        $this->uri = uri_string(true);

        $this->addClass("table");

        // set defaults
        $this->sortable = $this->config->sortable;
        $this->filterable = $this->config->filterable;
        if ($this->config->size=='sm') { $this->Small(); }
        if ($this->config->striped) { $this->Striped(); }

        $this->template = config("Rakoitde\ci4bs4table\Config\\".$this->config->templatename); 
        $this->perpage = $this->config->perpage;
        $this->addModel( );
        $this->request = \Config\Services::request();

        $this->createFiltervars();

        $this->addRequest();
    }

}


