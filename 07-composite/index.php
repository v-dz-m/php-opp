<?php

// Преимущества шаблона Composite:
// 1. Гибкость. Во всех элементах шаблона используется общий супертип;
// 2. Простота. Клиентскому коду за некоторым исключением не нужно проводить различий между контейнером и объектом-листом;
// 3. Неявная досягаемость. Объекты организованы в древовидную структуру с ссылками на дочерние объекты;
// 4. Явная досягаемость. Можно выполнить обход всех узлов древовидной структуры.

abstract class Unit
{
    public function addUnit(Unit $unit)
    {
        throw new UnitException(get_class($this) . " относится к листьям");
    }

    public function removeUnit(Unit $unit)
    {
        throw new UnitException(get_class($this) . " относится к листьям");
    }

    abstract public function bombardStrength(): int;
}

class Army extends Unit
{
    private $units = [];

    public function addUnit(Unit $unit)
    {
//        if (in_array($unit, $this->units, true)) {
//            return;
//        }
        $this->units [] = $unit;
    }

    public function removeUnit(Unit $unit)
    {
        $idx = array_search($unit, $this->units, true);
        if (is_int($idx)) {
            array_splice($this->units, $idx, 1, []);
        }
    }

    public function bombardStrength(): int
    {
        $ret = 0;
        foreach ($this->units as $unit) {
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }
}

class UnitException extends Exception
{

}

class Archer extends Unit
{
    public function bombardStrength(): int
    {
        return 4;
    }
}

class LaserCanon extends Unit
{
    public function bombardStrength(): int
    {
        return 44;
    }
}

// Добавлена армия, состоящая из 10 стрелков и 2 лазерных пушек
// Строки 24-26 закомментированы, так как исходный код воспринимает каждую единицу (стрелка или пушки) как один объект
// и не даёт добавить нового юнита в состав армии
$myArmy = new Army();
$archers = array_fill(0, 10, new Archer());
$canons = array_fill(0, 2, new LaserCanon());

foreach ($archers as $archer)
    $myArmy->addUnit($archer);
foreach ($canons as $canon)
    $myArmy->addUnit($canon);

print_r($myArmy->bombardStrength());