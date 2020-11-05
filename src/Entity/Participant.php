<?php

namespace App\Entity;

class Participant extends AbstractEntity implements GenericEntityInterface
{
    /** @var string */
    private string $firstname;

    /** @var string */
    private string $lastname;

    /** @var string */
    private string $email;

    /** @var string */
    private string $position;

    /** @var int|null */
    private ?int $sharesAmount;

    /** @var int */
    private int $parentId;

    public function __toString(): string
    {
        $names = [];
        $names[] = $this->firstname ?? null;
        $names[] = $this->lastname ?? null;

        return implode(' ', $names);
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @return int|null
     */
    public function getSharesAmount(): ?int
    {
        return $this->sharesAmount;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parentId;
    }

    /**
     * @param string $firstName
     * @return Participant
     */
    public function setFirstName(string $firstName): Participant
    {
        $this->firstname = $firstName;
        return $this;
    }

    /**
     * @param string $lastName
     * @return Participant
     */
    public function setLastName(string $lastName): Participant
    {
        $this->lastname = $lastName;
        return $this;
    }

    /**
     * @param string $email
     * @return Participant
     */
    public function setEmail(string $email): Participant
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $position
     * @return Participant
     */
    public function setPosition(string $position): Participant
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @param int|null $sharesAmount
     * @return Participant
     */
    public function setSharesAmount(?int $sharesAmount): Participant
    {
        $this->sharesAmount = $sharesAmount;
        return $this;
    }

    /**
     * @param int $parentId
     * @return Participant
     */
    public function setParentId(int $parentId): Participant
    {
        $this->parentId = $parentId;
        return $this;
    }
}
