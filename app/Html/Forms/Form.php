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

class Form
{
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
    /**
     * @var string
     */
    private $action;
    /**
     * @var bool
     */
    private $current_form_was_submitted;
    private $model;

    public function __construct(HtmlBuilder $html, UrlGenerator $url, Store $session)
    {

        $this->html = $html;
        $this->url = $url;
        $this->session = $session;
        $this->errors = $session->get('errors', new ViewErrorBag);
        $this->action = null;
        $this->model = null;
        $this->current_form_was_submitted = false;
    }

    public function open($route = null)
    {
        $this->action = (is_null($route) ? $this->url->current() : $route);
        $this->current_form_was_submitted = $this->old('_form_key') === $this->action;

        return new FormBuilder($this, $this->action, $this->html, $this->session);
    }

    public function model($model, $route = null)
    {
        $this->model = $model;
        return $this->open($route);
    }

    public function close()
    {
        $this->action = null;
        $this->current_form_was_submitted = false;
        $this->model = null;
        return '</fieldset></form>';
    }

    public function input($type, $name, $value = null)
    {
        $builder = new FieldBuilder($this->html, $name, $type);
        $builder->value($this->old($name, $value));
        if ($this->hasError($name))
            $builder->error($this->errors->first($name));
        return $builder;
    }

    public function display($name, $value = null)
    {
        $builder = new DisplayFieldBuilder($this->html, $name, $value);
        if (!is_null($value))
            $builder->value($value);
        return $builder;
    }

    public function hidden($name, $value)
    {
        $builder = new HiddenBuilder($this->html, $name);
        $builder->value($this->old($name, $value));
        return $builder;
    }

    public function dragula($name, $value)
    {
        $builder = new DragulaBuilder($this->html, $name, $value);
        return $builder;
    }

    public function upload($name)
    {
        $builder = new UploadBuilder($this->html, $name);
        if ($this->hasError($name))
            $builder->error($this->errors->first($name));
        return $builder;
    }

    public function select($name)
    {
        $builder = new SelectBuilder($this->html, $name);
        $builder->value($this->old($name));
        if($this->hasError($name))
            $builder->eror($this->errors->first($name));
        return $builder;
	}

    public function submit($text = 'Submit')
    {
        return new SubmitBuilder($this->html, $text);
    }

    public function text($name, $value = null)
    {
        return $this->input('text', $name, $value);
    }

    public function number($name, $value = null)
    {
        return $this->input('number', $name, $value);
    }

    public function password($name, $value = null)
    {
        return $this->input('password', $name, $value);
    }

    public function checkbox($name, $checked = false)
    {
        return new CheckBoxBuilder($this->html, $name, $checked);
    }

    private function old($name, $value = null)
    {
        if (!is_null($value))
            return $value;

        if (isset($this->session)) {
            if ($this->current_form_was_submitted || $name == '_form_key')
                return $this->session->getOldInput($this->transformKey($name));
        }

        if (!is_null($this->model)) {
            return $this->model->$name;
        }

        return null;
    }

    /**
     * Transform key from array to dot syntax.
     *
     * @param  string $key
     * @return string
     */
    protected function transformKey($key)
    {
        return str_replace(array('.', '[]', '[', ']'), array('_', '', '.', ''), $key);
    }

    /**
     * @param $name
     * @return bool
     */
    protected function hasError($name)
    {
        if ($this->current_form_was_submitted)
            return $this->errors->has($name);
        return false;
    }
}