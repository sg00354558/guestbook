<?php

namespace App\Entity;

use App\Repository\GuestbookRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;


#[ORM\Entity(repositoryClass: GuestbookRepository::class)]
class Guestbook
{
    // Set approval status 1 => Approved
    const APPROVAL_STATUS = 1;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=5)
     * @Assert\Length(max=100)
     */
    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column(nullable: true)]
    private ?bool $approvalStatus = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    /**    
     *  @Gedmo\Timestampable(on="create")
     */
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    /**    
     *  @Gedmo\Timestampable(on="update")
     */
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'guestbooks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function isApprovalStatus(): ?bool
    {
        return $this->approvalStatus;
    }

    public function setApprovalStatus(?bool $approvalStatus): self
    {
        $this->approvalStatus = $approvalStatus;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

     /**
     * Gets triggered only on insert

     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new \DateTime("now");
    }

    // /**
    //  * Gets triggered every time on update

    //  * @ORM\PreUpdate
    //  */
    // public function onPreUpdate()
    // {
    //     $this->updated = new \DateTime("now");
    // }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
