<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="IDX_UNIQ_EMAIL", columns={"email"}), @ORM\UniqueConstraint(name="IDX_UNIQ_USER", columns={"username"})})
 * @ORM\Entity
 */
class Users implements \JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=40, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=60, nullable=false)
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="admin", type="boolean", nullable=true)
     */
    private $admin = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=60, nullable=false)
     */
    private $password;


    /**
     * Users constructor.
     *
     * @param string $username username
     * @param string $email    email
     * @param string $password password
     * @param bool   $enabled  enabled
     * @param bool   $isAdmin  isAdmin
     */
    public function __construct(
        string $username = '',
        string $email = '',
        string $password = '',
        bool   $enabled = true,
        bool   $isAdmin = false
    ) {
        $this->id       = 0;
        $this->username = $username;
        $this->email    = $email;
        $this->setPassword($password);
        $this->enabled  = $enabled;
        $this->isAdmin  = $isAdmin;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return bool|null
     */
    public function getAdmin(): ?bool
    {
        return $this->admin;
    }

    /**
     * @param bool|null $admin
     */
    public function setAdmin(?bool $admin): void
    {
        $this->admin = $admin;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Representation of User as string
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->username;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array(
            'user' => array(
                'id'            => $this->id,
                'username'      => utf8_encode($this->username),
                'email'         => utf8_encode($this->email),
                'enabled'       => $this->enabled,
                'admin'         => $this->isAdmin
            )
        );
    }
}
