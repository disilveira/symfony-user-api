<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserActionTest extends WebTestCase
{
    public function test_delete_user(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/users/1');

        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_NO_CONTENT, $statusCode);
    }

    public function test_delete_user_without_id(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/users/');

        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_METHOD_NOT_ALLOWED, $statusCode);
    }

    public function test_delete_user_with_user_not_found(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/users/999');

        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
    }
}
