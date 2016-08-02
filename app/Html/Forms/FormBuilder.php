<?php
/*
	This file is part of BotQueue.

	BotQueue is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	BotQueue is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with BotQueue.  If not, see <http://www.gnu.org/licenses/>.
  */


namespace App\Html\Forms;


use Collective\Html\HtmlBuilder;
use Illuminate\Session\Store;

class FormBuilder
{
    /**
     * @var Form $form
     */
    private $form;
    /**
     * @var string $action
     */
    private $action;
    /**
     * @var HtmlBuilder $html
     */
    private $html;
    /**
     * @var Store $session
     */
    private $session;
    /**
     * @var array
     */
    private $attributes;

    public function __construct(Form $form,
                                $action,
                                HtmlBuilder $html,
                                Store $session)
    {
        $this->form = $form;
        $this->action = $action;
        $this->html = $html;
        $this->session = $session;
        $this->attributes = [
            'class'   => 'form-horizontal',
            'method'  => 'POST',
            'action'  => $action,
            'enctype' => "multipart/form-data"
        ];
    }

    public function formClass($class)
    {
        $this->attributes['class'] = $class;
        return $this;
    }

    public function id($id)
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function __toString()
    {
        return $this->render();
	}

    /**
     * @return string
     */
    private function render()
    {
        $html_attributes = $this->html->attributes($this->attributes);
        $result =  '<form'.$html_attributes.'><fieldset>';

        foreach($this->fields() as $field) {
            $result .= $field;
        }

        return $result;
    }

    /**
     * return FieldBuilder
     */
    private function fields()
    {
        return [
            $this->form->hidden('_token', $this->session->getToken()),
            $this->form->hidden('_form_key', $this->action)
        ];
    }
}