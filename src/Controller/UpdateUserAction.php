<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateUserAction
{
    #[Route("/users/{id}", methods: ["PUT"])]
    public function __invoke(EntityManagerInterface $entityManager, int $id, Request $request): Response
    {

        $requestBody = json_decode($request->getContent());

        $user = $entityManager->find(User::class, $id);

        if(null === $user){
            return new JsonResponse(['error' => 'Usuário não encontrado'], Response::HTTP_NOT_FOUND);
        }

        $user->setNome($requestBody->nome);
        $user->setSobrenome($requestBody->sobrenome);
        $user->setEmail($requestBody->email);
        $entityManager->persist($user);

        $entityManager->flush();


        return new JsonResponse(['status' => 'ok'], Response::HTTP_NO_CONTENT);
    }
}