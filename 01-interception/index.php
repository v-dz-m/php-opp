<?php

// Пример использования методов-перехватчиков, где в качестве такого метода выступает __set()
// При попытке обратиться к свойству property __set() вызывает метод setProperty()
class Person
{
    private $_name;
    private $_age;

    public function __set($property, $value)
    {
        $method = "set{$property}";
        if (method_exists($this, $method)) {
            return $this->$method($value);
        }
    }

    public function setName($name)
    {
        $this->_name = $name;
        if (!is_null($name)) {
            $this->_name = mb_strtoupper($this->_name);
        }
    }

    public function setAge($age)
    {
        $this->_age = $age;
    }

    public function sayHi()
    {
        echo "Hi, my name is {$this->_name} and I'm {$this->_age}";
    }
}

$p = new Person ();
$p->name = "Ivan";
$p->age = 15;
$p->sayHi();