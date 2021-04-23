<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserActionTest extends WebTestCase
{
    public function test_update_user(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'PUT',
            uri: '/users/2',
            content: json_encode([
                'nome' => 'Diego',
                'sobrenome' => "Almeida",
                'email' => 'diego.almeida@outlook.com'
            ])
        );

        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_NO_CONTENT, $statusCode);
    }

    public function test_update_user_with_user_not_found(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'PUT',
            uri: '/users/99',
            content: json_encode([
                'nome' => 'Diego',
                'sobrenome' => "Almeida",
                'email' => 'diego.almeida@outlook.com'
            ])
        );

        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
    }
}
