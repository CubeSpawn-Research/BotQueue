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
use InvalidArgumentException;

class CheckBoxBuilder extends FieldBuilder
{

	/**
	 * CheckBoxBuilder constructor.
	 * @param HtmlBuilder $html
	 * @param $name
	 * @param bool $checked
	 */
	public function __construct($html, $name, $checked)
	{
		parent::__construct($html, $name, 'checkbox');
		$this->checked($checked);
	}

	public function checked($checked = true)
	{
		return $this->value($checked);
	}

	public function value($value)
	{
		if($value !== true && $value !== false)
			throw new InvalidArgumentException("Checkbox value must be true or false");
		$this->value = $value;
		return $this;
	}

	public function render() {
		return
			'<div class="control-group">'.
				'<div class="controls">'.
					'<label class="checkbox">'.
						'<input '.$this->html->attributes($this->getAttributes()).'>'.
						'<strong>'.$this->label.'</strong>'.
					'</label>'.
					$this->helpText().
				'</div>'.
			'</div>';
	}

	protected function getAttributes() {
		$attributes = [
			'type' => $this->type,
			'name' => $this->name
		];

		if($this->value) {
			$attributes['checked'] = 'checked';
		}

		return $attributes;
	}
}