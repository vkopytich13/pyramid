<?php

namespace App\Entity;

use DateTime;

abstract class AbstractEntity
{
    /**
     * @var int|null
     */
    protected ?int $id;

    /**
     * @var string|null
     */
    protected ?string $dateCreated;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return AbstractEntity
     */
    public function setId(?int $id): AbstractEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateCreated(): ?string
    {
        return $this->dateCreated;
    }

    /**
     * @param string|null $dateCreated
     * @return AbstractEntity
     */
    public function setDateCreated(?string $dateCreated): AbstractEntity
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }
}
