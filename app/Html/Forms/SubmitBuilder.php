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

class SubmitBuilder extends FieldBuilder
{
	private $submitText;
    private $inline;

    /**
	 * SubmitBuilder constructor.
	 * @param HtmlBuilder $html
	 * @param $text
	 */
	public function __construct($html, $text)
	{
		parent::__construct($html, '', 'submit');
		$this->submitText = $text;
		$this->inputClass('btn btn-primary');
	}

	public function inline() {
        $this->inline = true;
        return $this;
    }

	public function render()
	{
        if($this->inline)
            return $this->button();

		return
			'<div class="form-actions">'.
				$this->button().
			'</div>';
	}

	public function getAttributes() {
		return [
			'type' => $this->type,
			'class' => $this->class,
		];
	}

    private function button()
    {
        return
            '<button '.$this->html->attributes($this->getAttributes()).'>'.
                $this->submitText.
            '</button>';
    }

}