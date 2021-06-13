<?php

namespace Rakoitde\ci4bs4table;

class Thtd extends TableElement
{

    use ClassFilterTrait;

    public string $field;

    public string $text = "";

    public string $tag;

    public string $colspan = "";

    public string $rowspan = "";

    protected string $html = "";

    protected array $htmlcondition;

    public $parser;

    public string $type = "text"; # text, date

    public string $format = "";

    public function Type($type, string $format = ""): self
    {
        $this->type = $type;
        $this->format = $format;
        return $this;
    }

    public function Field(string $field): self
    {
        $this->field = $field;
        return $this;
    }

    public function Text(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function Html(string $html, string $condition = "", array $convert = []): self
    {
        $htmlcondition = new \stdClass();
        $htmlcondition->html      = $html;
        $htmlcondition->condition = $condition;
        $htmlcondition->convert   = $convert;
        $this->htmlcondition[] = $htmlcondition;
        return $this;
    }

    public function Debug(): self
    {
        d($this);
        return $this;
    }

    public function Icon(string $icon, string $condition = "", string $class = ""): self
    {
        $html = str_replace("{icon}", $icon, $this->config->icontag);
        $html = str_replace("{class}", " {$class}", $html);

        $this->Html($html, $condition);

        return $this;
    }

    public function Center(): self
    {
        $this->addClass("text-center");
        return $this;
    }

    public function Right(): self
    {
        $this->addClass("text-right");
        return $this;
    }

    public function getHtml($row): string
    {
        if (!isset($this->html)) { return ""; }

        $html = $this->parser->setData($row)->renderString($this->html);

        return $html;
    }

    public function Colspan(string $colspan): self
    {
        $this->colspan = $colspan;
        return $this;
    }

    public function getColspan(): string
    {
        if (!isset($this->colspan)) { return ""; }

        return ' colspan="'.$this->colspan.'"';
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

    private function getHtmlCondition($row): string
    {

        if (!isset($this->htmlcondition)) { return $this->text; }

        $html="";

        foreach ($this->htmlcondition as $h) {

            if (count($h->convert)>0) {
                $row = $this->convert($row, $h->convert);
            }

            $value = $this->parser->setData($row)->renderString($h->html);

            if ($h->condition=="") { $html.=$value; continue; }

            list($operand_a, $operator, $operand_b) = json_decode($h->condition);

            $op_a = $this->parser->setData($row)->renderString($operand_a);
            $op_b = $this->parser->setData($row)->renderString($operand_b);
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
        }

        return $html;
    }

    public function getHref(bool $withnext = true): string
    {
        $href = '';

        return $href;
    }

    public function getAllClasses(): string
    {
        $classes = trim($this->getClasses().' '.implode(" ", $this->getFilteredClasses($this->values)));
        return $classes;
    }

    public function getAllHtml(): string
    {
        $html = $this->text.$this->getHtml($this->values).$this->getHtmlCondition($this->values);
        return $html;
    }

    public function toHtml($options=[]): string
    {
        #$classes = $this->getFilteredClasses([$this->field]);
        $classes = $this->getAllClasses();
        $tag = $this->tag;

        $data = [
            'cellclasses' => trim($this->getClasses().' '.implode(" ", $this->getFilteredClasses($this->values))),
            'tag' => $this->tag,
            'colspan' => $this->getColspan(),
            'sortable' => $this->sortable ?? false,
            'direction' => $this->directionicon ?? '',
            'href' => $this->getHref() ?? '',
            'html' => $this->getHtml($this->values).$this->getHtmlCondition($this->values),
        ];

        $html = view('Rakoitde\ci4bs4table\Views\Cell', $data);

        return $html;
    }

    public function __construct(string $text)
    {
        $this->field = $text;
        $this->config = new \Rakoitde\ci4bs4table\Config\Config();
        $this->parser = \Config\Services::parser();
    }

}
