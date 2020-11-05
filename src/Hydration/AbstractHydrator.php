<?php

namespace App\Hydration;

use App\Entity\GenericEntityInterface;

abstract class AbstractHydrator
{
    public static function hydrateRest(array $data, GenericEntityInterface $entity): GenericEntityInterface
    {
        $dateCreated = new \DateTime($data['date_created']);
        $dateCreated->sub(new \DateInterval('P1D'));

        $entity->setDateCreated($dateCreated);
        $entity->setId($data['entity_id']);

        return $entity;
    }
}
