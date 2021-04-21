<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateUserActionTest extends WebTestCase
{
    public function test_create_user_post(): void
    {
        $client = static::createClient();
        $client->request(method: 'POST', uri: '/users',
            content: json_encode([
                'nome' => 'Diego',
                'sobrenome' => "Almeida",
                'email' => 'diego.almeida@outlook.com',
                'endereco' => [
                    'estado' => 'MG',
                    'cidade' => 'Betim',
                    'bairro' => 'Ingá',
                    'rua' => 'Av. Edmeia Mattos',
                    'numero' => '99-B',
                    'complemento' => 'Casa'
                ]
            ])
        );

        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_CREATED, $statusCode);

    }
}