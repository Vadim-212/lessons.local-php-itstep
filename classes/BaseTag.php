<?php


use Tag\Attributes;
use Tag\Body;
use Tag\Name;

/**
 * Class BaseTag
 *
 * Базовый класс для реализации HTML тега
 */
abstract class BaseTag
{

    /**
     * @var Name
     */
    protected $name;
    /**
     * @var Attributes
     */
    protected $attributes;
    /**
     * @var Body
     */
    protected $body;

    /**
     * BaseTag constructor.
     * @param $name
     * @param array $attributes
     * @param Body|null $body
     */
    public function __construct($name, $attributes = [], Body $body = null)
    {

        if (!$name instanceof Name)
            $name = new Name($name);

        if (!$attributes instanceof Attributes)
            $attributes = new Attributes($attributes);

        if (!$body)
            $body = new Body();

        $this->name = $name;
        $this->attributes = $attributes;
        $this->body = $body;
    }

    /**
     * Возвращает текущий экмепляр имени тега
     * @return Name
     */
    function name(): Name {
        return $this->name;
    }

    /**
     * @return bool
     */
    function isClosing() {
        return $this->name()->isClosing();
    }

    /**
     * @return bool
     */
    function isSelfClosing() {
        return $this->name()->isSelfClosing();
    }

    /**
     * @return Body
     */
    function body(): Body {
        return $this->body;
    }

    /**
     * @param $value
     * @return $this
     */
    function appendBody($value) {
        $this->body()->append($value);
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    function prependBody($value) {
        $this->body()->prepend($value);
        return $this;
    }

    /**
     * @return $this
     */
    function clearBody() {
        $this->body()->clear();
        return $this;
    }

    /**
     * @return Attributes
     */
    function attributes(): Attributes {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    function setAttributes(array $attributes) {
        $this->attributes()->set($attributes);
        return $this;
    }

    /**
     * @return array
     */
    function getAttributes() {
        return $this->attributes()->toArray();
    }

    /**
     * @return $this
     */
    function clearAttributes() {
        $this->attributes()->clear();
        return $this;
    }

    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    function setAttribute(string $key, $value) {
        $this->attributes()->set($key, $value);
        return $this;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    function getAttribute(string $key) {
        return $this->attributes()->get($key);
    }

    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    function appendAttribute(string $key, $value) {
        $this->attributes()->append($key, $value);
        return $this;
    }

    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    function prependAttribute(string $key, $value) {
        $this->attributes()->prepend($key, $value);
        return $this;
    }

    /**
     * @param string $key
     * @return $this
     */
    function deleteAttribute(string $key) {
        $this->attributes()->delete($key);
        return $this;
    }

    /**
     * @param BaseTag $tag
     * @return $this
     */
    function appendTo(BaseTag $tag) {
        $tag->appendBody($this);
        return $this;
    }

    /**
     * @param BaseTag $tag
     * @return $this
     */
    function prependTo(BaseTag $tag) {
        $tag->prependBody($this);
        return $this;
    }

    /**
     * @return string
     */
    function toString() {
        $tag = "<" . $this->name() . $this->attributes();

        if ($this->isSelfClosing())
            $tag .= " />";
        else
            $tag .= ">" . $this->body() . "</" . $this->name() . ">";

        return $tag;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return $this
     */
    function __call(string $name, array $arguments): self
    {
        $this->attributes()->$name(... $arguments);
        return $this;
    }

    /**
     * @param string $name
     * @param $value
     */
    function __set(string $name, $value)
    {
        $this->attributes()->$name = $value;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    function __get(string $name)
    {
        return $this->attributes()->$name;
    }

    /**
     * @param string $key
     * @return bool
     */
    function __isset(string $key)
    {
        return isset($this->attributes()->$key);
    }

    /**
     * @param string $key
     */
    function __unset(string $key)
    {
        unset($this->attributes()->$key);
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->toString();
    }

}