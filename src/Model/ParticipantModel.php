<?php

namespace App\Model;

use App\DB\QueryBuilder;
use App\Entity\Participant;
use App\Hydration\ParticipantHydrator;
use Exception;

class ParticipantModel extends AbstractModel
{
    private const TABLE = 'participants';
    private const PRESIDENT = 'president';
    private const VICE_PRESIDENT = 'vice president';
    private const MANAGER = 'manager';
    private const NOVICE = 'novice';


    /**
     * @return Participant
     */
    public function saveFirst(): Participant
    {
        $data = [
            'entity_id'     => 1,
            'firstname'     => 'Mike',
            'lastname'      => 'Patterson',
            'email'         => 'mike_pat@example.org',
            'position'      => self::PRESIDENT,
            'shares_amount' => 10000,
            'date_created'  => date('Y-m-d H:i:s', 1273449600),
            'parent_id'     => 0,
        ];

        $where = [
            'entity_id' => $data['entity_id'],
            'email' => $data['email'],
        ];

        $sql = QueryBuilder::findAllBy(self::TABLE, $where);
        $findRow = $this->connection->run($sql, $where)->fetch();

        if (!$findRow) {
            echo "Miss matches the main user. Generating the main user... President is here!<br/>";

            $sql = QueryBuilder::cleanOut(self::TABLE);
            $this->connection->run($sql);

            $sql = QueryBuilder::insert($data, self::TABLE);
            $this->connection->run($sql, $data);

            return ParticipantHydrator::hydrate($data);
        } else {
            echo "President already exists! It's all good!<br/>";
            return ParticipantHydrator::hydrate($findRow);
        }
    }

    /**
     * @param Participant $entity
     * @return Participant|null
     * @throws Exception
     */
    public function save(Participant $entity): ?Participant
    {
        $data = [
            'firstname'     => $entity->getFirstName(),
            'lastname'      => $entity->getLastName(),
            'email'         => $entity->getEmail(),
            'position'      => $entity->getPosition(),
            'shares_amount' => $entity->getSharesAmount(),
            'parent_id'     => $entity->getParentId(),
        ];

        $user = $this->findByEmail($data['email']);

        if ($user === null) {
            echo $sql = QueryBuilder::insert($data, self::TABLE);
            $this->connection->run($sql, $data);

            if ($entity->getId() === null) {
                $entity->setId((int)$this->connection->open()->lastInsertId());
            }
            return $entity;
        } else {
            throw new \PDOException("Table has the same user with such email - " . $data['email']);
        }
    }

    /**
     * @param int $id
     * @return Participant|null
     */
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

    /**
     * @param string $email
     * @return Participant|null
     */
    public function findByEmail(string $email): ?Participant
    {
        $entity = null;
        $where = ['email' => $email];
        $sql = QueryBuilder::findAllBy(self::TABLE, $where);
        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute([
            'email' => $email
        ]);

        $findRow = $statement->fetch();
        if (!empty($findRow)) {
            $entity = ParticipantHydrator::hydrate($findRow);
        }

        return $entity;
    }

    // method for check affiliates quantity
}

