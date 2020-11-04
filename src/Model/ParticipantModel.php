<?php

namespace App\Model;

use App\DB\QueryBuilder;
use App\Entity\Participant;
use App\Hydration\ParticipantHydrator;

class ParticipantModel extends AbstractModel
{
    protected const TABLE = 'participants';

    public function save(Participant $entity)
    {
        $data = [
            'firstname'     => $entity->getFirstName(),
            'lastname'      => $entity->getLastName(),
            'email'         => $entity->getEmail(),
            'position'      => $entity->getPosition(),
            'shares_amount' => $entity->getSharesAmount(),
            'parent_id'     => $entity->getParentId(),
        ];

        $sql = QueryBuilder::insert($data, self::TABLE);
        if ($entity->getId() !== null) {
            $data['entity_id'] = $entity->getId();
        }

        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute($data);

        if ($entity->getId() === null) {
            $entity->setId((int)$dbCon->lastInsertId());
        }

        return $entity;
    }

    public function findOne(int $id): ?Participant
    {
        $entity = null;
        $sql = QueryBuilder::findOneBy(self::TABLE);
        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute([
            'entity_id' => $id
        ]);
        $findRow = $statement->fetch();

        if (!empty($findRow)) {
            $entity = ParticipantHydrator::hydrate($findRow);
        }

        return $entity;
    }

    // method for check affiliates quantity

    // method for check exists of main user
}

