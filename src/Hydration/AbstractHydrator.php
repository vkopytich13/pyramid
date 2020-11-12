<?php

namespace App\Hydration;

use App\Entity\GenericEntityInterface;
use Faker;

abstract class AbstractHydrator
{
    public static function hydrateRest(array $data, GenericEntityInterface $entity): GenericEntityInterface
    {
        $faker = Faker\Factory::create();
        $dateCreated = $faker->dateTimeBetween($startDate = date('Y-m-d H:i:s', 1273449600), $endDate = '-01 days')->format('Y-m-d H:i:s');

        $entity->setDateCreated($dateCreated);
        $entity->setId($data['entity_id']);

        return $entity;
    }
}
