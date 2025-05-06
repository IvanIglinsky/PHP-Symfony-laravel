<?php
class User extends Authenticatable implements JWTSubject
{
public function getJWTIdentifier() { return $this->getKey(); }
public function getJWTCustomClaims() { return []; }
}
