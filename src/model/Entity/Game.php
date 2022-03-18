<?php

namespace Memory\Model\Entity;

use DateTime;

class Game
{
    private $id;
    private $score;
    private $playedAt;

    public function __construct()
    {
        $playedAt = (new DateTime())->format('d-m-Y H:i:s');
        $this->setPlayedAt($playedAt);
    }

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
    public function getScore(): string
    {
        return $this->score;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setScore(float $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getPlayedAt(): string
    {
        return $this->playedAt;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setPlayedAt(string $playedAt): self
    {
        $this->playedAt = $playedAt;

        return $this;
    }
}
