<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CreateUserAction
{

    #[Route("/users", methods: ["POST"])]
    public function __invoke(EntityManagerInterface $entityManager, SerializerInterface $serializer, Request $request): Response
    {

        $user = $serializer->deserialize($request->getContent(), User::class, 'json');
        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse([
            'status' => 'ok',
            'id_usuario' => $user->getId()
        ], Response::HTTP_CREATED);
    }
}