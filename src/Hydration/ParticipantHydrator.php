<?php

namespace App\Hydration;

use App\Entity\Participant;

class ParticipantHydrator extends AbstractHydrator
{
    public static function hydrate(array $data): Participant
    {
        $entity = new Participant();
        $entity->setFirstName($data['firstname'])
               ->setLastName($data['lastname'])
               ->setEmail($data['email'])
               ->setPosition($data['position'])
               ->setSharesAmount($data['shares_amount'])
               ->setParentId($data['parent_id']);

        parent::hydrateRest($data, $entity);

        return $entity;
    }
}
