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

class DragulaBuilder extends FieldBuilder
{

	/**
	 * HiddenBuilder constructor.
	 * @param HtmlBuilder $html
	 * @param $name
     * @param $value
	 */
	public function __construct($html, $name, $value)
	{
		parent::__construct($html, $name, 'hidden');
        $this->value = $value;
	}

	public function render()
	{
		return
			'<div class="control-group" style="margin-bottom: 10px">'
			    .$this->labelField().
                '<div class="controls">'.
			        '<input '.$this->html->attributes($this->getAttributes()).'/>'.
			    '</div>'.
			'</div>';
	}

    protected function labelField()
    {
        if($this->label)
            return '<label style="text-align: center; margin-bottom: 0" for="'.$this->id.'">'.
            '<strong>'.$this->label.'</strong></label>';
        return '';
    }

	public function getAttributes() {
		return [
			'type' => $this->type,
			'name' => $this->name,
			'value' => $this->value
		];
	}
}