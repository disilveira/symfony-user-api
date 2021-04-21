<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateUserAction
{

    #[Route("/users", methods: ["POST"])]
    public function __invoke(EntityManagerInterface $entityManager, Request $request): Response
    {

        $requestBody = json_decode($request->getContent());

        $user = new User();
        $user->setNome($requestBody->nome);
        $user->setSobrenome($requestBody->sobrenome);
        $user->setEmail($requestBody->email);
        $entityManager->persist($user);

        $address = new Address();
        $address->setEstado($requestBody->endereco->estado);
        $address->setCidade($requestBody->endereco->cidade);
        $address->setBairro($requestBody->endereco->bairro);
        $address->setRua($requestBody->endereco->rua);
        $address->setNumero($requestBody->endereco->numero);
        $address->setComplemento($requestBody->endereco->complemento);
        $address->setUser($user);
        $entityManager->persist($address);

        $entityManager->flush();

        return new JsonResponse([
            'status' => 'ok',
            'id_usuario' => $user->getId(),
            'id_endereco' => $address->getId()
        ], Response::HTTP_CREATED);
    }
}