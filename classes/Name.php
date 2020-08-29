<?php

class Name
{

    protected $name;

    const selfClosing = [
        'area', 'base', 'br', 'col', 'embed', 'hr',
        'img', 'input', 'link', 'meta', 'param', 'source',
        'track', 'wbr', 'command', 'keygen', 'menuitem'
    ];

    public function __construct(string $name)
    {
        $this->set($name);
    }

    function set(string $name) {
        $name = strtolower($name);
        $this->name = trim($name);
        return $this;
    }

    function get() {
        return $this->name;
    }

    function isClosing() {
        return !in_array($this->get(), self::selfClosing);
    }

    function isSelfClosing() {
        return !$this->isClosing();
    }

    function toString() {
        return $this->get();
    }

    function __toString()
    {
        return $this->toString();
    }

}