<?php

// Данный пример шаблона Singleton позволяет решить следующие проблемы:
// объект типа должен быть доступен любому объекту в проектируемой системе;
// объект типа не должен сохраняться в глобальной переменной, значение которой может быть изменено случайно;
// в проектируемой системе не должно быть лодного объекта типа
class Preferences
{
    private $props = [];
    private static $instance;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (empty(self::$instance))
            self::$instance = new Preferences();
        return self::$instance;
    }

    public function setProperty(string $key, string $val)
    {
        $this->props[$key] = $val;
    }

    public function getProperty(string $key): string
    {
        return $this->props[$key];
    }
}

$pref1 = Preferences::getInstance();
$pref1->setProperty("name", "Vadim");
unset($pref1);
$pref2 = Preferences::getInstance();
print $pref2->getProperty("name");
