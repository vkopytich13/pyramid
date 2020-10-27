<?php

return [
    "DB" => [
        "db_host" => "mysql",
        "db_user" => "homestead",
        "db_pass" => "secret",
        "db_name" => "homestead",
    ],
    "president" => [
        'entity_id'     => 1,
        'firstname'     => 'Mike',
        'lastname'      => 'Patterson',
        'email'         => 'mike_pat@example.org',
        'position'      => 'president',
        'shares_amount' => 10000,
        'start_date'    => date('Y-m-d H:i:s', 1273449600),
        'parent_id'     => 0,
    ],
    "vice_president" => [
        'entity_id'     => 2,
        'firstname'     => 'Patric',
        'lastname'      => 'Mahomes',
        'email'         => 'pat_mahomes@example.org',
        'position'      => 'vice president',
        'shares_amount' => 5000,
        'start_date'    => '2010-05-12 00:00:00',
        'parent_id'     => 1,
    ]
];
