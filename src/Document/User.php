<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[MongoDB\Document]
class User //implements PasswordAuthenticatedUserInterface
{
    #[MongoDB\Id]
    private $id;

    #[MongoDB\Field(type: 'string')]
    #[Assert\NotBlank]
    private string $fullName;

    #[MongoDB\Field(type: 'string')]
    #[Assert\NotBlank]
    private string $user;

    #[MongoDB\Field(type: 'string')]
    #[Assert\NotBlank]
    private string $password;

    #[MongoDB\Field(type: 'string')]
    #[Assert\NotBlank]
    private string $address;

    #[MongoDB\Field(type: 'string')]
    #[Assert\NotBlank]
    private string $phone;

    #[MongoDB\Field(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Email( message: "Not is a valid email" )]
    #[Assert\Unique]
    private string $email;

    #[MongoDB\Field(type: 'bool')]
    private bool $authorization = false;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     * @return User
     */
    public function setFullName(string $fullName): User
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return User
     */
    public function setUser(string $user): User
    {
        $this->user = $user;
        return $this;
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
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return User
     */
    public function setAddress(string $address): User
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return User
     */
    public function setPhone(string $phone): User
    {
        $this->phone = $phone;
        return $this;
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
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAuthorization(): bool
    {
        return $this->authorization;
    }

    /**
     * @param bool $authorization
     * @return User
     */
    public function setAuthorization(bool $authorization): User
    {
        $this->authorization = $authorization;
        return $this;
    }
}
