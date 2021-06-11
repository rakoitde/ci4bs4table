<?php

namespace Rakoitde\ci4bs4form;

class FileElement extends FormElement
{
 
    public function toHtml(): string
    {

        $formGroup = '<!-- Start '.$this->type.': '.$this->getId().' -->'.PHP_EOL;
        $formGroup.= '<div class="custom-file mb-3">'.PHP_EOL;
        $formGroup.= "\t".'<input type="'.$this->type.'" name="'.$this->name.'" class="'.$this->getClasses().'" id="'.$this->id.'" '.$this->getDisabled().$this->getReadonly().'>'.PHP_EOL;
        $formGroup.= "\t".'<label class="custom-file-label" for="'.$this->id.'">'.$this->label.'</label>'.PHP_EOL;
        $formGroup.= "\t".'<small id="'.$this->id.'_message" class="form-text'.$this->MessageColor().'">'.$this->MessageText().'</small>'.PHP_EOL;
        $formGroup.= '</div>'.PHP_EOL;

        return $formGroup;
    }

    public function __construct(string $id)
    {
        parent::__construct($id);
        $this->addClass("custom-file-input");
    }

}
