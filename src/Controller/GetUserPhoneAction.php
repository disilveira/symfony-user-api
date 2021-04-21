<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetUserPhoneAction
{
    #[Route("/users/{id}/phones", methods: ["GET"])]
    public function __invoke(EntityManagerInterface $entityManager, int $id): Response
    {
        return new JsonResponse([
            'status' => 'ok'
        ]);
    }
}
