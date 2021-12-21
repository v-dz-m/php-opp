<?php

// Шаблон предназначен для динамического подключения дополнительного поведения к объекту.
// Предоставляет гибкую альтернативу практике создания подклассов с целью расширения функциональности.
abstract class Tile
{
    abstract public function getWealthFactor(): int;
}

class Plains extends Tile
{
    private $wealthFactor = 2;

    public function getWealthFactor(): int
    {
        return $this->wealthFactor;
    }
}

abstract class TileDecorator extends Tile
{
    protected $tile;

    public function __construct(Tile $tile)
    {
        $this->tile = $tile;
    }
}

class DiamondDecorator extends TileDecorator
{
    public function getWealthFactor(): int
    {
        return $this->tile->getWealthFactor() + 2;
    }
}

class PollutionDecorator extends TileDecorator
{
    public function getWealthFactor(): int
    {
        return $this->tile->getWealthFactor() - 4;
    }
}

$tile1 = new Plains();
$tile2 = new DiamondDecorator(new Plains());
$tile3 = new PollutionDecorator(new Plains());

var_dump([$tile1, $tile2, $tile3]);