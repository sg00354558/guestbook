<?php
namespace App\Service;

use App\Entity\Guestbook;
use Doctrine\ORM\EntityManagerInterface;


class GuestbookService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Update the status of the Guest from pending to Approved (access only to ROLE_ADMIN)
     * @param Guestbook $guestbook
     */
    public function updateGuestbookStatus(Guestbook $guestbook)
    {
        $guestbook->setApprovalStatus(GuestBook::APPROVAL_STATUS);
        $em= $this->entityManager;
        $em->persist($guestbook);
        $em->flush();
    }
}