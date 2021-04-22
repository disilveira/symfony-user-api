<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ListUserAction
{
    #[Route("/users/", methods: ["GET"])]
    public function __invoke(EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        $users = $entityManager->getRepository(User::class)->findAll();
        $response = $serializer->serialize($users, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
             }
         ]);
        return JsonResponse::fromJsonString($response);
    }
}
