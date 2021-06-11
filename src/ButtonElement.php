<?php

namespace Rakoitde\ci4bs4form;

class ButtonElement extends FormElement
{

	public string $text;

    public function Size($size): self
    {
        $this->addClass("btn-".$size);
        return $this;
    }

	public function Text(string $text): self
	{
		$this->text = $text;
		return $this;
	}

	private function getText(): string
	{
		return isset($this->text) ? $this->text : "";
	}

	public function Color($color): self
	{
		$colors = ['primary','secondary','success','danger','warning','info','light','dark','link'];
		$color = in_array($color, $colors) ? $color : "primary";
		$this->addClass("btn-".$color);
		return $this;
	}

	public function OutlineColor($color): self
	{
		$colors = ['primary','secondary','success','danger','warning','info','light','dark','link'];
		$color = in_array($color, $colors) ? $color : "primary";
		$this->addClass("btn-outline-".$color);
		return $this;
	}

    public function toHtml(): string
    {
    	$button = '<!-- Start Button: '.$this->getId().' -->'.PHP_EOL;
        $button.= '<button id="'.$this->getId().'" type="'.$this->getType().'" class="'.$this->getClasses().'">'.$this->getText().'</button>'.PHP_EOL;

        return $button;
    }
 
    public function __construct(string $id)
    {
        parent::__construct($id);
        $this->type = "button";
        $this->addClass("btn");
    }

}
