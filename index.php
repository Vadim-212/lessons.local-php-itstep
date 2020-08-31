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


// 1
class Room {
    protected static $studentsCount;
    protected static $students = [];

    static function addStudent(Student $student) {
        array_push(self::$students, $student);
        self::$studentsCount++;
    }

    static function removeStudent(Student $student) {
        $findedStudent = array_search($student, self::$students);
        if(!$findedStudent) {
            array_splice(self::$students, $findedStudent, 1);
            self::$studentsCount--;
        }
        
    }

    static function getStudentsCount() {
        return self::$studentsCount;
    }
}

class Student {
    function enter() {
        Room::addStudent($this);
    }

    function leave() {
        Room::removeStudent($this);
    }

}


// 2
class CarFactory {
    protected static $cars = [];

    static function make(): Car {
        $newCar = new Car();
        array_push(self::$cars, $newCar);
        return $newCar;
    }

    static function getAverageDistance() {
        $averageDistance = 0;
        foreach (self::$cars as $value) {
            $averageDistance += $value->getOdometerValue();
        }
        return $averageDistance / count(self::$cars);
    }
}

class Car {
    protected $odometer = 0;
    
    function move(float $speed, float $hours) {
        $distance = $speed * $hours;
        $this->odometer += $distance;
    }

    function getOdometerValue() {
        return $this->odometer;
    }
}
