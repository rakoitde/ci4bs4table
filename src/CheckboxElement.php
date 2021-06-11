<?php

namespace Rakoitde\ci4bs4form;

class CheckboxElement extends FormElement
{
 
    public function toHtml(): string
    {
        $formGroup = '<!-- Start Checkbox: '.$this->getId().' -->'.PHP_EOL;
        $formGroup.= '<div class="form-group form-check">'.PHP_EOL;
        $formGroup.= "\t".'<input type="'.$this->type.'" name="'.$this->name.'" class="'.$this->getClasses().'"  id="'.$this->id.'" value="checked"'.$this->getValue().$this->getDisabled().$this->getReadonly().'>'.PHP_EOL;
        $formGroup.= "\t".'<label for="'.$this->id.'" class="form-check-label">'.$this->label.'</label>'.PHP_EOL;
        $formGroup.= "\t".'<small id="'.$this->id.'_message" class="form-text'.$this->MessageColor().'">'.$this->MessageText().'</small>'.PHP_EOL;
        $formGroup.= '</div>'.PHP_EOL;

        return $formGroup;
    }

    public function __construct(string $id)
    {
        parent::__construct($id);
        $this->addClass("form-check-input");
    }

}
