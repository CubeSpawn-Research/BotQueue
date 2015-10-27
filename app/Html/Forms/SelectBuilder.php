<?php


namespace App\Html\Forms;


use ArrayAccess;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Html\HtmlBuilder;

class SelectBuilder extends FieldBuilder
{
    private $options;

    /**
     * SelectBuilder constructor.
     * @param HtmlBuilder $html
     * @param $name
     */
    public function __construct($html, $name)
    {
        parent::__construct($html, $name, 'select');
        $this->options = [];
    }

    /**
     * @param ArrayAccess|Collection $options
     * @param string|callable $selector
     * @return $this
     */
    public function options($options, $selector)
    {
        $map = function($m) { return $m; };

        if (is_string($selector)) {
            $map = function ($model) use ($selector) {
                return $model->$selector;
            };
        } elseif (is_callable($selector)) {
            $map = $selector;
        }

        if ($options instanceof Collection) {
            $options = $options->getDictionary();
        }

        if ($options instanceof ArrayAccess || is_array($options)) {
            foreach ($options as $key => $value) {
                $this->options[$key] = $map($value);
            }
        }

        return $this;
    }

    public function render() {
        return
            '<div class="control-group'.
            ($this->hasError() ? ' error' : '').'">'
                .$this->labelField().
                '<div class="controls">'.
                $this->selectField().
                $this->errorText().
                $this->helpText().
                '</div>'.
            '</div>';
    }

    private function selectField()
    {
        $result = '<select name="'.$this->name.'">';

        foreach($this->options as $key => $value) {
            $result .= '<option value="'.$key.'">'.$value.'</option>';
        }

        return $result.'</select>';
    }
}