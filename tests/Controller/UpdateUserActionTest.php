<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserActionTest extends WebTestCase
{

    private EntityManagerInterface $em;
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
        $this->em = self::$kernel->getContainer()->get('doctrine')->getManager();
        $tool = new SchemaTool($this->em);
        $metadata = $this->em->getClassMetadata(User::class);
        $tool->dropDatabase();
        try {
            $tool->createSchema([$metadata]);
        } catch (ToolsException $e) {
            $this->fail('Impossível criar o banco de dados: "'.$e->getMessage().'"');
        }
    }

    public function test_update_user(): void
    {
        
        $user = new User();
        $user->setNome('Diego');
        $user->setSobrenome('Almeida');
        $user->setEmail('diego.almeida@outlook.com');
        $this->em->persist($user);
        $this->em->flush();

        $this->client->request(
            method: 'PUT',
            uri: '/users/1',
            content: json_encode([
                'nome' => 'Diego',
                'sobrenome' => "Almeida",
                'email' => 'diego.almeida@outlook.com'
            ])
        );

        $statusCode = $this->client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_NO_CONTENT, $statusCode);
    }
}
