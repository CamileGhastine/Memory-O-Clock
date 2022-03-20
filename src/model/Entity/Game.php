<?php

namespace Memory\Model\Entity;

use DateTime;

/**
 * Class Game
 * @package Memory\Model\Entity
 */
class Game
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var float
     */
    private float $result;

    /**
     * Get the value of id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of title
     * @return float
     */
    public function getResult(): float
    {
        return $this->result;
    }

    /**
     * Set the value of title
     * @return  self
     */
    public function setResult(float $result): self
    {
        $this->result = $result;

        return $this;
    }
}
