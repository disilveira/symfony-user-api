<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GetUserActionTest extends WebTestCase
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

    public function test_get_user_should_return_200(): void
    {   
        $user = new User();
        $user->setNome('Diego');
        $user->setSobrenome('Almeida');
        $user->setEmail('diego.almeida@outlook.com');
        $this->em->persist($user);
        $this->em->flush();

        $this->client->request('GET', '/users/1');
        $statusCode = $this->client->getResponse()->getStatusCode();
        $this->assertSame(Response::HTTP_OK, $statusCode);
    }

    public function test_get_user_should_return_404(): void
    {
        $this->client->request('GET', '/users/999');
        $statusCode = $this->client->getResponse()->getStatusCode();
        $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
    }

}