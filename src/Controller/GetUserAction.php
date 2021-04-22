<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GetUserAction
{   
    #[Route("/users/{id}", methods: ["GET"])]
    public function __invoke(EntityManagerInterface $entityManager, SerializerInterface $serializer, int $id): Response
    {   
        $user = $entityManager->find(User::class, $id);

        if(null === $user){
            return new JsonResponse(['error' => 'Usuário não encontrado'], Response::HTTP_NOT_FOUND);
        }

        $response = $serializer->serialize($user, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
             }
         ]);

        return JsonResponse::fromJsonString($response);
    }
}