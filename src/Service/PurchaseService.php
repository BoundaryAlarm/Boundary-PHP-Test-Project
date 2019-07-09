<?php

namespace BoundaryWS\Service;

use Illuminate\Database\Connection;

class PurchaseService
{
    private CONST DB_TABLE = 'purchases';

    /**
     * @var Connection
     */
    private $db;

    /**
     * ProductService constructor.
     *
     * @param Connection $dbConnection
     */
    public function __construct(Connection $dbConnection)
    {
        $this->db = $dbConnection;
    }

    /**
     * @return array
     */
    public function getPurchases(): array
    {
        return $this->db
            ->table(self::DB_TABLE)
            ->select()
            ->get()
            ->toArray();
    }
}
