<?php

namespace App\Domain\Model;

interface UserInterface
{
    public function getLogin(): string;

    public function getPassword(): string;

    public function getTitle(): string;

    public function getLastname(): string;

    public function getFirstname(): string;

    public function getGender(): string;

    public function getEmail(): string;

    public function getPicture(): string;

    public function getAddress(): string;
}
