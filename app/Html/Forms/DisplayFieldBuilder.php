<?php


namespace App\Html\Forms;


use Illuminate\Html\HtmlBuilder;

class DisplayFieldBuilder extends FieldBuilder
{

    /**
     * DisplayFieldBuilder constructor.
     * @param HtmlBuilder $html
     * @param $name
     * @param $value
     */
    public function __construct($html, $name, $value)
    {
        parent::__construct($html, $name, 'none');
        $this->value($value);
    }

    public function render()
    {
        return
            '<div class="control-group">'
                .$this->labelField().
                '<div class="controls" style="margin-top: 5px">'.
                    $this->value
                    .$this->helpText().
                '</div>'.
            '</div>';
    }
}