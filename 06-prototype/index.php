<?php

class Sea
{
    private $navigability = 0;

    public function __construct(int $navigability)
    {
        $this->navigability = $navigability;
    }
}

class EarthSea extends Sea
{

}

class MarsSea extends Sea
{

}

class Plains
{

}

class EarthPlains extends Plains
{

}

class MarsPlains extends Plains
{

}

class Forest
{

}

class EarthForest extends Forest
{

}

class MarsForest extends Forest
{

}

class TerrainFactory
{
    private $sea;
    private $forest;
    private $plains;

    public function __construct(Sea $sea, Plains $plains, Forest $forest)
    {
        $this->sea = $sea;
        $this->plains = $plains;
        $this->forest = $forest;
    }

    public function getSea(): Sea
    {
        return clone $this->sea;
    }

    public function getPlains(): Plains
    {
        return clone $this->plains;
    }

    public function getForest(): Forest
    {
        return clone $this->forest;
    }
}

$factory = new TerrainFactory(
    new EarthSea(-1),
    new EarthPlains(),
    new EarthForest()
);
print_r($factory->getSea());
print_r($factory->getPlains());
print_r($factory->getForest());