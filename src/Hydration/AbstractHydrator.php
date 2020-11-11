<?php

namespace App\Hydration;

use App\Entity\GenericEntityInterface;
use Faker;

abstract class AbstractHydrator
{
    public static function hydrateRest(array $data, GenericEntityInterface $entity): GenericEntityInterface
    {
        $faker = Faker\Factory::create();
        $dateCreated = $faker->dateTimeBetween($startDate = '-10 years', $endDate = '-01 days');

        $entity->setDateCreated($dateCreated);
        $entity->setId($data['entity_id']);

        echo "<pre>";
        var_dump($entity);
        echo "</pre>";

        return $entity;
    }
}
