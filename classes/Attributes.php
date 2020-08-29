<?php

class Attributes
{

    protected $attributes;

    public function __construct(array $attributes = [])
    {
        $this->set($attributes);
    }

    function set($key, $value = null) {

        if (is_array($key))
            $this->attributes = $key;
        else
            $this->attributes[(string)$key] = $value;

        return $this;
    }

    function get(string $key) {
        return $this->attributes[$key] ?? null;
    }

    function append(string $key, $value) {
        return $this->set($key, $this->get($key) . $value);
    }

    function prepend(string $key, $value) {
        return $this->set($key, $value . $this->get($key));
    }

    function clear() {
        return $this->set([]);
    }

    function delete(string $key) {
        $old = $this->toArray();
        unset($old[$key]);
        return $this->set($old);
    }

    function toArray() {

        if ($this->isEmpty())
            return [];

        return array_filter($this->attributes, function ($item) {
            return $item !== null || $item !== '' || $item !== false;
        });
    }

    function isEmpty() {
        return empty($this->attributes);
    }

    function exists(string $key) {
        return isset($this->attributes[$key]);
    }

    function toString() {

        if ($this->isEmpty())
            return '';

        $attributes = $this->toArray();
        $result = '';

        foreach ($attributes as $key => $value)
            $result .= " {$key}=\"{$value}\"";

        return $result;
    }

    function __call(string $name, array $arguments)
    {
        return $this->set($name, ... $arguments);
    }

    function __set(string $key, $value)
    {
        $this->set($key, $value);
    }

    function __get(string $key)
    {
        return $this->get($key);
    }

    function __isset(string $key)
    {
        return $this->exists($key);
    }

    function __unset(string $key)
    {
        $this->delete($key);
    }

    function __toString() {
        return $this->toString();
    }

}