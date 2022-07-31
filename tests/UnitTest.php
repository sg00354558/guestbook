<?php

namespace App\Tests;

use App\Entity\Guestbook;
use PHPUnit\Framework\TestCase;
use App\Service\GuestbookService;
use Doctrine\ORM\EntityManagerInterface;

class UnitTest extends TestCase
{
    public function testGuestbookApproval(): void
    {
        $guestbook = new Guestbook();
        $guestbook->setApprovalStatus(0);
        $guestService = new GuestbookService($this->createEntityManagerMock());
        $guestService->updateGuestbookStatus($guestbook);

        $this->assertEquals(Guestbook::APPROVAL_STATUS, $guestbook->isApprovalStatus());
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function createEntityManagerMock()
    {
        return $this->createMock(EntityManagerInterface::class);
    }
}

