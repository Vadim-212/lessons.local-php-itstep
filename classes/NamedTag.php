<?php


use Tag\Body;

abstract class NamedTag extends BaseTag
{

    protected $tagName = 'div';

    public function __construct($attributes = [], Body $body = null)
    {
        parent::__construct($this->tagName, $attributes, $body);
    }

    static function make() {
        return new static();
    }

}