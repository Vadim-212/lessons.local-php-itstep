<?php

spl_autoload_register(function ($name) {
    $path = "./classes/$name.php";
    
    if(!file_exists($path))
        throw new Exception("File $path not found.");

    require_once $path;

    if(!class_exists($name))
        throw new Exception("Class $name not found in $path.");
});
