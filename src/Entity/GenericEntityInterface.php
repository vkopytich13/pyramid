<?php

namespace App\Entity;

use DateTime;

interface GenericEntityInterface
{
    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @param int|null $id
     */
    public function setId(?int $id);

    /**
     * @return DateTime|null
     */
    public function getDateCreated(): ?DateTime;

    /**
     * @param DateTime|null $dateCreated
     */
    public function setDateCreated(?DateTime $dateCreated);
}
