<?php

namespace Rakoitde\ci4bs4table;

#use Rakoitde\ChartJs\Data\Data;
#use CodeIgniter\Validation\Validation;
use CodeIgniter\HTTP\IncomingRequest;

#use Rakoitde\ci4bs4form\InputElement;


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

    protected $entities;

    protected int $perpage = 15;

    protected $config;


# tr,td:  table-active,primary,secondary,success,danger,warning,info,light,dark
# tr,td bg: bg-primary,success,warning,danger,info

    public function Inline(bool $inline = true):self
    {
      $this->inline = $inline;
      if ($inline) { $this->addClass("form-inline"); }
      return $this;
    }

    public function Id(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function Caption(string $caption = ""): self
    {
        $this->caption = $caption;
        return $this;
    }

    public function Small(): self
    {
        $this->addClass("table-sm");
        return $this;
    }

    public function Dark(): self
    {
        $this->addClass("table-dark");
        return $this;
    }
 
    public function Light(): self
    {
        $this->addClass("table-light");
        return $this;
    }

    public function Striped(): self
    {
        $this->addClass("table-striped");
        return $this;
    }

    public function Bordered(): self
    {
        $this->addClass("table-bordered");
        return $this;
    }

    public function Borderless(): self
    {
        $this->addClass("table-borderless");
        return $this;
    }

    public function Hover(): self
    {
        $this->addClass("table-hover");
        return $this;
    }

    public function Thead(): Thead
    {
        if(!isset($this->thead)) { $this->thead = new Thead(); }
        $this->thead->BaseUrl($this->baseurl);
        $this->thead->Values($this->values);
        return $this->thead;
    }

    public function Tbody(): Tbody
    {
        if(!isset($this->tbody)) { $this->tbody = new Tbody(); }
        $this->tbody->BaseUrl($this->baseurl);
        $this->tbody->Values($this->values);
        $this->tbody->addEntities($this->getEntities());
        return $this->tbody;
    }

    public function Tfoot(): Tfoot
    {
        if(!isset($this->tfoot)) { $this->tfoot = new Tfoot(); }
        $this->tfoot->BaseUrl($this->baseurl);
        $this->tfoot->Values($this->values);
        return $this->tfoot;
    }

    public function getPagerLinks()
    {
        return $this->model->pager->links();
    }

    public function toHtml(): string
    {
        $data = [
            "pager"        => $this->model->pager,
            "tableid"      => $this->id,
            "tableclasses" => $this->getClasses(),
            "caption"      => $this->caption ?? '',
            "method"       => $this->config->method,
            "baseurl"      => $this->baseurl,
            "thead"        => $this->thead,
            "tbody"        => $this->tbody,
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

    public function toJson(): string
    {
        $json = json_encode($this);
        return $json;
    }

    public function addRequest(IncomingRequest $request) {
      $this->request = $request;
      if ($request->getMethod()=='post') {
        $values = $request->getPost();
      } elseif ($request->getMethod()=='get') {
        $values = $request->getGet();
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

    public function addModel( $model )
    {
      $this->model = $model;
      $this->fields = array_keys($this->model->first()->toArray());

      return $this->model;
    }

    public function getModel()
    {
      return $this->model;
    }

    public function getEntities()
    {
      // Filter
      $filters  = $this->getFilter();

      if (count($filters)>0) {
        $this->model->groupStart();
        foreach ($this->getFilter() as $field => $filter) {
          if ($filter=="") { continue; }

          if (is_string($filter))
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

    public function getSort(): array
    {
      $sortvar = $this->config->sortvar;
      if (isset($this->values[$sortvar])) { return $this->values[$sortvar]; }
      return [];
    }

    public function getFilter(): array
    {
      $filtervar = $this->config->filtervar;

      if (isset($this->values[$filtervar])) { 


$filters = array_filter($this->values[$filtervar], function($k) {
    return $k != '';
});
return $filters;

        return $filters; 
      }
      return [];
    }

    public function getSearch(): string
    {
      $searchvar = $this->config->searchvar;
      if (isset($this->values[$searchvar])) { return $this->values[$searchvar]; }
      return "";
    }

    public function __construct(string $id = null) {
      if (isset($id)) { $this->id = $id; }
      $this->addClass("table");
      $this->config = new \Rakoitde\ci4bs4table\Config\Config();
      $this->perpage = $this->config->perpage;
    }

}
