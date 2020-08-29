<?php


namespace App\Formatter;


use App\Document\ExampleDocument;
use App\Entity\Book;
use App\Entity\Example;
use App\Entity\UserBook;

class ExampleFormatter
{
    public static function format(Example $example): array
    {
        return [
            'id' => $example->getId(),
            'firstname' => $example->getFirstname(),
            'lastname' => $example->getLastname(),
            'email' => $example->getEmail(),
            'username' => $example->getUsername()
        ];
    }
}