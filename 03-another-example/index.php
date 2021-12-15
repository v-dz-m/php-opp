<?php

// Аналогичный пример, где метод addEmployee() класса NastyBoss вызывает создание сотрудника одного из трёх вариантов
// случайным образом (подобно предыдущему примеру, но в другой реализации)
// Метод projectFails() злобного начальника вызывает удаление одного из сотрудников с вызовом у того метода fire()
// Листинг 09.08
abstract class Employee
{
    protected $name;
    private static $types = ['Minion', 'CluedUp',
        'WellConnected'];

    public static function recruit(string $name)
    {
        $num = rand(1, count(self::$types)) - 1;
        $class = __NAMESPACE__ . "\\" . self::$types[$num];
        return new $class($name);
    }

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function fire();
}

// Листинг 09.02
class Minion extends Employee
{
    public function fire()
    {
        print "{$this->name}: я уберу co стола<br>";
    }
}

// Листинг 09.06
class CluedUp extends Employee
{
    public function fire()
    {
        print "{$this->name}: я вызову адвоката<br>";
    }
}

// Листинг 09.09
class WellConnected extends Employee
{
    public function fire()
    {
        print "{$this->name}: я позвоню папе<br>";
    }
}

// Листинг 09.05
class NastyBoss
{
    private $employees = [];

    public function addEmployee(Employee $employee)
    {
        $this->employees[] = $employee;
    }

    public function projectFails()
    {
        if (count($this->employees)) {
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }
}

// Листинг 09.10
$boss = new NastyBoss();
$boss->addEmployee( Employee::recruit( "Игорь" ) );
$boss->addEmployee( Employee::recruit( "Владимир" ) );
$boss->addEmployee( Employee::recruit( "Мария" ) );
$boss->projectFails ();
$boss->projectFails ();
$boss->projectFails();
