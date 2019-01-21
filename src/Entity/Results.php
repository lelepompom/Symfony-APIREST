<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Results
 *
 * @ORM\Entity
 * @ORM\Table(
 *     name    = "results",
 *     indexes = {
 *          @ORM\Index(name="FK_USER_ID_idx", columns={ "user_id" })
 *     }
 * )
 */
class Results implements \JsonSerializable
{
    /**
     * Result id
     *
     * @var integer
     *
     * @ORM\Column(
     *     name     = "id",
     *     type     = "integer",
     *     nullable = false
     * )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    private $id;

    /**
     * Result value
     *
     * @var integer
     *
     * @ORM\Column(
     *     name     = "result",
     *     type     = "integer",
     *     nullable = false
     *     )
     */
    private $result;

    /**
     * Result user
     *
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(
     *          name                 = "user_id",
     *          referencedColumnName = "id",
     *          onDelete             = "cascade"
     *     )
     * })
     */
    private $user;

    /**
     * Result time
     *
     * @var \DateTime
     *
     * @ORM\Column(
     *     name     = "time",
     *     type     = "datetime",
     *     nullable = false
     *     )
     */
    private $time;

    /**
     * Result constructor.
     *
     * @param int       $result result
     * @param Users      $user   user
     * @param \DateTime $time   time
     */
    public function __construct(
        int $result = 0,
        Users $user = null,
        \DateTime $time = null
    ) {
        $this->id     = 0;
        $this->result = $result;
        $this->user   = $user;
        $this->time   = $time;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getResult(): int
    {
        return $this->result;
    }

    /**
     * @param int $result
     */
    public function setResult(int $result): void
    {
        $this->result = $result;
    }

    /**
     * @return Users
     */
    public function getUser(): Users
    {
        return $this->user;
    }

    /**
     * @param Users $user
     */
    public function setUser(Users $user): void
    {
        $this->user = $user;
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     */
    public function setTime(\DateTime $time): void
    {
        $this->time = $time;
    }

    /**
     * Implements __toString()
     *
     * @return string
     * @link   http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.tostring
     */
    public function __toString(): string
    {
        return sprintf(
            '%3d - %3d - %22s - %s',
            $this->id,
            $this->result,
            $this->user,
            $this->time->format('Y-m-d H:i:s')
        );
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link   http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since  5.4.0
     */
    public function jsonSerialize(): array
    {
        return array(
            'result' => array(
                'id'     => $this->id,
                'result' => $this->result,
                'user'   => $this->user,
                'time'   => $this->time->format('Y-m-d H:i:s')
            )
        );
    }
}
