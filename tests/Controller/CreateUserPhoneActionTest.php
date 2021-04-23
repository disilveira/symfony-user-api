<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateUserPhoneActionTest extends WebTestCase
{
    public function test_create_user_phone_post(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'POST',
            uri: '/users/2/phones',
            content: json_encode([
                'codigo_area' => 31,
                'numero' => "3531-2990"
            ])
        );

        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_CREATED, $statusCode);
    }

    public function test_create_user_phone_with_invalid_data(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'POST',
            uri: '/users/2/phones',
            content: json_encode([
                'codigo_area' => 31
            ])
        );

        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_BAD_REQUEST, $statusCode);
    }

    public function test_create_user_phone_with_user_not_found(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'POST',
            uri: '/users/999/phones',
            content: json_encode([
                'codigo_area' => 31,
                'numero' => "3531-2990"
            ])
        );

        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
    }
}
