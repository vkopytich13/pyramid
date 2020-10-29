<?php
namespace App\DB;

interface DBConnectionInterface
{
    public function getCreds(): array;
    public function open();
}
