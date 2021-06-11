<?php

namespace Rakoitde\ci4bs4form;

class FormElement
{

    public string $id;

    public string $name;

    public string $type;

    public string $label;

    private string $size = "sm";

    private $value;

    public array $classes;

    public string $placeholder ="";

    public bool $disabled = false;

    public bool $readonly = false;

    public string $message = "";

    protected string $error_message="";

    private bool $hasError = false;


    public function Id(string $id): self
    {

        $this->id = $id;
        if (!isset($this->label)) { $this->label = $id; }
        if (!isset($this->name)) { $this->name = $id; }
        return $this;
    }

    public function getId(): string
    {
        return isset($this->id) ? $this->id :"";
    }

    public function getName(): string
    {
        return isset($this->name) ? $this->name : $this->id;
    }

    public function Type(string $type = 'text'): self
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function Size($size): self
    {
        $this->size=$size;
        #$this->addClass("form-control-".$size);
        return $this;
    }

    public function Label(string $label): self
    {

        $this->label = $label;
        return $this;
    }

    public function Placeholder(string $placeholder): self
    {

        $this->placeholder = $placeholder;
        return $this;
    }

    public function Value($value): self
    {
        $this->value = $value;
        return $this;
    }

    public function getValue()
    {
        return $this->value ?? "";
    }

    public function Readonly(bool $readonly = true): self
    {
        $this->readonly = $readonly;
        return $this;
    }

    public function getReadonly(): string
    {
        return $this->readonly ? " readonly" : "";
    }

    public function Disabled(bool $disabled = true): self
    {
        $this->disabled = $disabled;
        return $this;
    }

    public function getDisabled(): string
    {
        return $this->disabled ? " disabled" : "";
    }

    public function addClass(string $class): self
    {
        $classes = explode(" ", $class);
        foreach ($classes as $class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function getClasses(): string
    {
        return isset($this->classes) ? implode(" ", array_unique($this->classes)) : "";
    }

    public function Message(string $message): self
    {

        $this->message = $message;
        return $this;
    }

    public function ErrorMessage(string $error_message): self
    {

        $this->error_message = $error_message;
        return $this;
    }

    public function HasError(bool $hasError = true): self
    {
        $this->hasError = $hasError;
        $this->addClass("border-danger");
        return $this;
    }

    public function MessageColor(): string
    {
        $messageColor = $this->hasError==true ? " text-danger" : " text-muted";
        return $messageColor;
    }

    public function MessageText(): string
    {
        return $this->error_message>"" ? $this->error_message : $this->message;
    }

    public function toHtml(): string
    {

        $formGroup = '<!-- Start '.$this->type.': '.$this->getId().' -->'.PHP_EOL;
        $formGroup.= '<div class="form-group">'.PHP_EOL;
        $formGroup.= "\t".'<label for="'.$this->id.'">'.$this->label.'</label>'.PHP_EOL;
        $formGroup.= "\t".'<input type="'.$this->type.'" name="'.$this->name.'" class="'.$this->getClasses().'" id="'.$this->id.'" value="'.$this->getValue().'" placeholder="'.$this->placeholder.'"'.$this->getDisabled().$this->getReadonly().'>'.PHP_EOL;
        $formGroup.= "\t".'<small id="'.$this->id.'_message" class="form-text'.$this->MessageColor().'">'.$this->MessageText().'</small>'.PHP_EOL;
        $formGroup.= '</div>'.PHP_EOL;

        return $formGroup;
    }

    public function __construct(string $id)
    {

        $this->id = $id;
        if (!isset($this->label)) { $this->label = ucfirst($id); }
        if (!isset($this->name)) { $this->name = $id; }

    }
}
