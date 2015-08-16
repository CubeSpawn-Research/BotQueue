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
use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

class FormBuilder {
	use Macroable;

	/**
	 * @var HtmlBuilder
	 */
	private $html;
	/**
	 * @var UrlGenerator
	 */
	private $url;
	/**
	 * @var Store
	 */
	private $session;
	/**
	 * @var MessageBag
	 */
	private $errors;

	public function __construct(HtmlBuilder $html, UrlGenerator $url, Store $session)
	{

		$this->html = $html;
		$this->url = $url;
		$this->session = $session;
		$this->errors = $session->get('errors', new ViewErrorBag)->default;
	}

	public function open() {
		$attributes = [
			'class'   => 'form-horizontal',
			'method'  => 'POST',
			'action'  => $this->url->current(),
			'enctype' => "multipart/form-data"
		];

		$attributes = $this->html->attributes($attributes);

		return
			'<form'.$attributes.'><fieldset>'.
			$this->hidden('_token', $this->session->getToken());
	}

	public function close() {
		return '</fieldset></form>';
	}

	public function input($type, $name, $value = null)
	{
		$builder = new FieldBuilder($this->html, $name, $type);
		$builder->value($this->old($name, $value));
		if($this->errors->has($name))
			$builder->error($this->errors->first($name));
		return $builder;

	}

	public function hidden($name, $value) {
		$builder = new HiddenBuilder($this->html, $name);
		$builder->value($this->old($name, $value));
		return $builder;
	}

	public function submit($text)
	{
		return new SubmitBuilder($this->html, $text);
	}

	public function text($name, $value = null)
	{
		return $this->input('text', $name, $value);
	}

	public function password($name, $value = null)
	{
		return $this->input('password', $name, $value);
	}

	public function checkbox($name, $checked = false)
	{
		return new CheckBoxBuilder($this->html, $name, $checked);
	}

	private function old($name, $value)
	{
		if($value != null)
			return $value;

		if(isset($this->session))
			return $this->session->getOldInput($this->transformKey($name));

		return null;
	}

	/**
	 * Transform key from array to dot syntax.
	 *
	 * @param  string  $key
	 * @return string
	 */
	protected function transformKey($key)
	{
		return str_replace(array('.', '[]', '[', ']'), array('_', '', '.', ''), $key);
	}
}