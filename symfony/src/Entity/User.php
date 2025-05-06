<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity()]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
#[ORM\Id]
#[ORM\GeneratedValue]
#[ORM\Column]
private ?int $id = null;

#[ORM\Column(type: 'string', unique: true)]
private string $email;

#[ORM\Column(type: 'string')]
#[Ignore] // Щоб не повертати пароль в JSON-відповідях
private string $password;

#[ORM\Column(type: 'json')]
private array $roles = [];

public function getId(): ?int
{
return $this->id;
}

public function getEmail(): string
{
return $this->email;
}

public function setEmail(string $email): self
{
$this->email = $email;
return $this;
}

/**
* A visual identifier that represents this user (used for login)
*/
public function getUserIdentifier(): string
{
return $this->email;
}

/**
* @deprecated since Symfony 5.3, use getUserIdentifier() instead
*/
public function getUsername(): string
{
return $this->email;
}

public function getPassword(): string
{
return $this->password;
}

public function setPassword(string $password): self
{
$this->password = $password;
return $this;
}

public function getRoles(): array
{
$roles = $this->roles;

$roles[] = 'ROLE_CLIENT';
return array_unique($roles);
}

public function setRoles(array $roles): self
{
$this->roles = $roles;
return $this;
}

public function eraseCredentials(): void
{

}
}