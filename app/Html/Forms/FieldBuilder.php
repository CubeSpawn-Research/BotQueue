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


use Illuminate\Html\HtmlBuilder;
use Illuminate\Support\Facades\Validator;

class FieldBuilder
{

    /**
     * @var Form
     */
    protected $html;

    protected $id;
	protected $name;
	protected $value;
	protected $label;
	protected $help;
	protected $error;
	protected $type;
	protected $class;
    protected $attrs;

	public function __construct(HtmlBuilder $html, $name, $type)
    {
        $this->html = $html;
        $this->name = $name;
        $this->id = $name;
        $this->type = $type;
        $this->class = 'input-xlarge';
        $this->attrs = [];
    }

	public function id($id)
    {
        $this->id = e($id);
        return $this;
    }

	public function value($value)
    {
        if(!is_null($value))
            $this->value = e($value);

        return $this;
    }

	public function label($label)
    {
        $this->label = e($label);
        return $this;
    }

	public function help($help)
    {
        $this->help = e($help);
        return $this;
    }

	public function error($error)
    {
        $this->error = e($error);
        return $this;
    }

	public function hasError()
    {
        return $this->error !== null;
    }

	public function __toString()
    {
        return $this->render();
    }

	public function render()
    {
        return
            '<div class="control-group' .
            ($this->hasError() ? ' error' : '') . '">'
            . $this->labelField() .
            '<div class="controls">' .
            '<input ' . $this->html->attributes($this->getAttributes()) . '/>' .
            $this->errorText() .
            $this->helpText() .
            '</div>' .
            '</div>';
    }

	protected function labelField()
    {
        if ($this->label)
            return '<label class="control-label" for="' . $this->id . '">' .
            '<strong>' . $this->label . '</strong></label>';
        return '';
    }

	protected function errorText()
    {
        if ($this->hasError())
            return '<span class="help-inline">' . $this->error . '</span>';
        return '';
    }

	protected function helpText()
    {
        if ($this->help)
            return '<p class="help-block">' . $this->help . '</p>';
        return '';
    }

	/**
     * @return array
     */
	protected function getAttributes()
    {
        return array_merge([
            'type' => $this->type,
            'class' => $this->class,
            'name' => $this->name,
            'value' => $this->value,
        ],
            $this->attrs
        );
    }

	public function inputClass($class)
    {
        $this->class = $class;
        return $this;
    }

    public function disabled()
    {
        $this->attrs['disabled'] = true;
        return $this;
    }

    public function defaultValue($value) {
        if(is_null($this->value))
            $this->value = $value;

        return $this;
    }
}