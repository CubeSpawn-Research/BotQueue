<?php


namespace App\Html\Forms;


use Collective\Html\HtmlBuilder;

class UploadBuilder extends FieldBuilder
{

    /**
     * UploadBuilder constructor.
     * @param HtmlBuilder $html
     * @param $name
     */
    public function __construct($html, $name)
    {
        parent::__construct($html, $name, 'file');
    }
}