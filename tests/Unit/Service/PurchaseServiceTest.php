<?php

namespace Tests\Unit\Service;

use BoundaryWS\Service\PurchaseService;
use Illuminate\Database\Connection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class PurchaseServiceTest extends TestCase
{
    /**
     * @var PurchaseService
     */
    private $subject;

    /**
     * @var Connection|MockObject
     */
    private $db;

    /**
     * @var Builder|MockObject
     */
    private $qb;

    public function setUp()
    {
        $this->db = $this->createMock(Connection::class);
        $this->qb = $this->createMock(Builder::class);

        $this->db
            ->method('table')
            ->with('purchases')
            ->willReturn($this->qb);

        $this->subject = new PurchaseService($this->db);
    }

    public function testGetPurchases(): void
    {
        $results = [
            [
                'user_id' => 11,
                'product_id' => 22,
                'quantity' => 10,
            ]
        ];

        $collection = $this->createMock(Collection::class);
        $collection
            ->expects($this->once())
            ->method('toArray')
            ->willReturn($results);

        $this->qb
            ->expects($this->once())
            ->method('get')
            ->willReturn($collection);

        $this->qb
            ->expects($this->once())
            ->method('select')
            ->willReturn($this->qb);

        $products = $this->subject->getPurchases();

        $this->assertEquals($results, $products);
    }
}
