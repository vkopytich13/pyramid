<?php

namespace App\Model;

use App\DB\QueryBuilder;
use App\Entity\Participant;
use App\Hydration\ParticipantHydrator;
use Faker;

class ParticipantModel extends AbstractModel
{
    const TABLE          = 'participants';
    const PRESIDENT      = 'president';
    const VICE_PRESIDENT = 'vice president';
    const MANAGER        = 'manager';
    const NOVICE         = 'novice';
    const COUNT_USERS    = 5;

//    parent_id from DB
    public function generateNestedUsers()
    {
        $faker = Faker\Factory::create();
        $this->saveFirst();

        for ($i=1; $i <= self::COUNT_USERS; $i++) {
            echo "<pre>";
            var_dump($i);
            echo "</pre>";
            $data = [
                'firstname'     => $faker->firstName,
                'lastname'      => $faker->lastName,
                'email'         => $faker->safeEmail,
                'position'      => $faker->randomElement([self::MANAGER, self::NOVICE]),
                'shares_amount' => $faker->numberBetween(1, 500),
                'date_created'  => $faker->dateTimeBetween($startDate = date('Y-m-d H:i:s', 1273449600), $endDate = '-01 days')->format('Y-m-d H:i:s'),
                'parent_id'     => $i,
            ];

            echo "<pre>";
            var_dump($data);
            echo "</pre>";

            $this->saveOne($data);
        }
    }

    /**
     * Inserting the main user (President) in the table 'Participants'.
     *
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
        $findRow = $this->findOne($data['entity_id']);

        if (!$findRow) {
            echo "Miss matches the main user. Generating the main user... President is here!<br/>";

            $this->cleanAll(self::TABLE);
            return $this->saveOne($data);
        } else {
            if ($findRow['email'] !== $data['email']) {
                echo "Miss matches the main user with admin email. Generating the main user... President is here!<br/>";

                $this->cleanAll(self::TABLE);
                return $this->saveOne($data);
            }
            echo "President already exists! It's all good!<br/>";

            return ParticipantHydrator::hydrate($findRow);
        }
    }

    /**
     * Inserting one record in the table 'Participants'.
     *
     * @param array $user
     * @return Participant
     */
    public function saveOne(array $user): Participant
    {
        $findUser = $this->findByEmail($user['email']);

        if (!$findUser) {
            $sql = QueryBuilder::insert($user, self::TABLE);
            $dbCon = $this->connection->open();

            $statement = $dbCon->prepare($sql);
            $statement->execute($user);

            return ParticipantHydrator::hydrate($user);
        } else {
            throw new \PDOException("Table has the same user with such email - {$user['email']}");
        }
    }

    /**
     * Search record by ID.
     *
     * @param int $id
     * @return array|bool
     */
    public function findOne(int $id)
    {
        $sql = QueryBuilder::findOneBy(self::TABLE);
        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute([
            'entity_id' => $id
        ]);

        return $statement->fetch();
    }

    /**
     * Search record by email.
     *
     * @param string $email
     * @return array|bool
     */
    public function findByEmail(string $email)
    {
        $where = ['email' => $email];
        $sql = QueryBuilder::findAllBy(self::TABLE, $where);
        $dbCon = $this->connection->open();
        $statement = $dbCon->prepare($sql);
        $statement->execute($where);

        return $statement->fetch();
    }

    /**
     * Truncate all rows from table.
     *
     * @param string $tableName
     */
    public function cleanAll(string $tableName)
    {
        $sql = QueryBuilder::cleanOut($tableName);
        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute();
    }

    // method for check affiliates quantity
}

