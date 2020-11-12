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
     * @return string|null
     */
    public function getDateCreated(): ?string;

    /**
     * @param string|null $dateCreated
     */
    public function setDateCreated(?string $dateCreated);
}
