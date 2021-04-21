<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateUserAction
{
    #[Route("/users")]
    public function __invoke(): Response
    {
        return new JsonResponse(['status' => 'ok']);
    }
}