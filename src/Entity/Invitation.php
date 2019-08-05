<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Invitation
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\InvitationRepository")
 * @ORM\Table(name="invitations")
 */
class Invitation
{
    /**
     * @var integer|null $id
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @var User|null $userSender
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="id", fetch="EXTRA_LAZY")
     */
    private $userSender;

    /**
     * @var User|null $userInvited
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="id", fetch="EXTRA_LAZY")
     */
    private $userInvited;

    /**
     * @var integer $state
     * @ORM\Column(name="state", type="integer", nullable=false)
     */
    private $state;

    /**
     * Invitation constructor.
     * @param User|null $userSender
     * @param User|null $userInvited
     */
    public function __construct(?User $userSender, ?User $userInvited)
    {
        $this->userSender = $userSender;
        $this->userInvited = $userInvited;
        $this->state = 0;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return User|null
     */
    public function getUserSender(): ?User
    {
        return $this->userSender;
    }

    /**
     * @param User|null $userSender
     * @return void
     */
    public function setUserSender(?User $userSender): void
    {
        $this->userSender = $userSender;
    }

    /**
     * @return User|null
     */
    public function getUserInvited(): ?User
    {
        return $this->userInvited;
    }

    /**
     * @param User|null $userInvited
     * @return void
     */
    public function setUserInvited(?User $userInvited): void
    {
        $this->userInvited = $userInvited;
    }

    /**
     * @return integer
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @param integer $state * @return void
     */
    public function setState(int $state): void
    {
        $this->state = $state;
    }

    /**
     * @return false|string
     */
    public function __toString(): string
    {
        return json_encode(get_object_vars($this));
    }
}
