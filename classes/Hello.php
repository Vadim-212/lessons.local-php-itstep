<?php

class Hello {

protected $to;
protected $from;

function __construct($to = null, $from = null) {
    $this->to($to);
    $this->from($from);
}

protected function formatName($name) {

    if (is_null($name))
        return '';

    if (!is_string($name))
        $name = (string)$name;

    $name = strtolower($name);
    return ucwords($name);
}

function to($name) {
    $this->to = $this->formatName($name);
    return $this;
}

function from($name) {
    $this->from = $this->formatName($name);
    return $this;
}

function say() {
    $str =  'Hello ' . $this->to;

    if ($this->from)
        $str .= " from {$this->from}";

    return $str . '!';
}

}
