<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteUserAction
{
    #[Route("/users/{id}", methods: ["DELETE"])]
    public function __invoke(EntityManagerInterface $entityManager, int $id): Response
    {
        $user = $entityManager->find(User::class, $id);
        
        if(null === $user){
            return new JsonResponse(['error' => 'Usuário não encontrado'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($user);
        $entityManager->flush();

        return new JsonResponse(['status' => 'ok'], Response::HTTP_NO_CONTENT);

    }
}
