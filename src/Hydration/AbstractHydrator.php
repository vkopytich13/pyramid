<?php

namespace App\Hydration;

use App\Entity\GenericEntityInterface;
use DateTime;

abstract class AbstractHydrator
{
    public static function hydrateRest(array $data, GenericEntityInterface $entity): GenericEntityInterface
    {
        $dateCreated = new DateTime($data['date_created']);

        $entity->setDateCreated($dateCreated);
        $entity->setId($data['entity_id']);

        return $entity;
    }
}
