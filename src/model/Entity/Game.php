<?php

namespace Memory\Model\Entity;

use DateTime;

class Game
{
    private int $id;
    private float $result;

    /**
     * Get the value of id
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get the value of title
     */
    public function getResult(): float
    {
        return $this->result;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setResult(float $result): self
    {
        $this->result = $result;

        return $this;
    }
}
