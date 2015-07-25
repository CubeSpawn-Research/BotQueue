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


namespace App\Html;


use Illuminate\Html\HtmlBuilder;

class FieldBuilder {

	/**
	 * @var FormBuilder
	 */
	protected $html;

	protected $id;
	protected $name;
	protected $value;
	protected $label;
	protected $help;
	protected $error;
	protected $type;

	public function __construct(HtmlBuilder $html, $name, $type)
	{
		$this->html = $html;
		$this->name = $name;
		$this->id   = $name;
		$this->type = $type;
	}

	public function id($id)
	{
		$this->id = $id;
		return $this;
	}

	public function value($value)
	{
		$this->value = $value;
		return $this;
	}

	public function label($label)
	{
		$this->label = $label;
		return $this;
	}

	public function help($help)
	{
		$this->help = $help;
		return $this;
	}

	public function error($error)
	{
		$this->error = $error;
		return $this;
	}

	public function __toString()
	{
		return $this->render();
	}

	public function render()
	{
		return
			'<div class="control-group">'
				.$this->labelField().
				'<div class="controls">'.
					'<input '.$this->html->attributes($this->getAttributes()).'>'.
				'</div>'.
				$this->errorText().
				$this->helpText().
			'</div>';
	}

	protected function labelField()
	{
		if($this->label)
			return '<label class="control-label" for="'.$this->id.'">'.
					'<strong>'.$this->label.'</strong></label>';
		return '';
	}

	protected function errorText()
	{
		if($this->error)
			return '<span class="help-inline">'.$this->error.'</span>';
		return '';
	}

	protected function helpText()
	{
		if($this->help)
			return '<p class="help-block">'.$this->help.'</p>';
		return '';
	}

	/**
	 * @return array
	 */
	protected function getAttributes()
	{
		return [
			'type' => $this->type,
			'class' => 'input-xlarge',
			'name' => $this->name,
			'value' => $this->value
		];
	}
}