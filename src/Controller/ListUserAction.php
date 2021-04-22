<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListUserAction
{
    #[Route("/users/", methods: ["GET"])]
    public function __invoke(EntityManagerInterface $entityManager): Response
    {

        $users = $entityManager->getRepository(User::class)->findAll();
        $rows = count($users);

        $response = [];

        foreach ($users as $user) {
            $response[] = [
                'id' => $user->getId(),
                'nome' => $user->getNome(),
                'sobrenome' => $user->getSobrenome(),
                'email' => $user->getEmail()
            ];
        }

        return new JsonResponse([
            'rows' => $rows, 
            'users' => $response
        ]);
    }
}
