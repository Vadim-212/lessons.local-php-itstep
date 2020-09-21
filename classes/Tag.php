<?php


/**
 * Class Tag
 *
 * Класс для генерации HTML тега.
 *
 */
class Tag extends BaseTag
{

    /**
     * @param string $name Имя тега
     * @param array $arguments Массив аргументов
     * @return static
     */
    static function __callStatic(string $name, array $arguments) {
        return new static($name, ... $arguments);
    }

}