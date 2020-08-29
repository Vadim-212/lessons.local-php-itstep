<?php

class Body
{

    protected $body;

    public function __construct()
    {
        $this->clear();
    }

    function clear() {
        $this->body = [];
    }

    function append($value) {
        $this->body[] = $value;
        return $this;
    }

    function prepend($value) {
        array_unshift($this->body, $value);
        return $this;
    }

    function isEmpty() {
        return empty($this->body);
    }

    function toString() {

        if ($this->isEmpty())
            return '';

        return implode($this->body);
    }

    function __toString()
    {
        return $this->toString();
    }

}