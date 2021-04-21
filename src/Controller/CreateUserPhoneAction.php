<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateUserPhoneAction
{

    #[Route("/users/{id}/phones", methods: ["POST"])]
    public function __invoke(EntityManagerInterface $entityManager, int $id, Request $request): Response
    {

        $requestBody = json_decode($request->getContent());

        $user = $entityManager->find(User::class, $id);
        
        if(null === $user){
            return new JsonResponse(['error' => 'Usuário não encontrado'], Response::HTTP_NOT_FOUND);
        }

        $phone = new Phone();
        $phone->setCodigoArea($requestBody->codigo_area);
        $phone->setNumero($requestBody->numero);
        $phone->setUser($user);
        $entityManager->persist($phone);

        $entityManager->flush();

        return new JsonResponse([
            'status' => 'ok',
            'id' => $phone->getId()
        ], Response::HTTP_CREATED);
    }
}