<?php

/**
 * Class Doctype
 *
 * Класс для генерации Doctype.
 *
 */
class Doctype
{
    protected static $name = '!DOCTYPE';

    static function get($type = 'html') {
        return '<' . Doctype::$name . ' ' . $type . '>';
    }
}