<?php

/*require_once('sql_helpers.php');

$connection = sql_connect('localhost','root','root','lessons');

$data = sql_select($connection, 'books', '*', [
    'id' => 2
]);

var_dump($data);

sql_close($connection);
*/

//require_once "classes/Tag.php";
require_once "autoload.php";

$tag = new Tag('a');
$tag
    ->setAttribute('href', '//google.com')
    ->appendBody('Google');

$tag->addClass('link-home')->addClass('link')->addClass('                 a ')->addClass('link')->removeClass('link')->addClass('a');
echo $tag;