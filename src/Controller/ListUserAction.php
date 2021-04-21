<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Phone;
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

        $response = [];

        foreach ($users as $user) {
            $response[] = [
                'id' => $user->getId(),
                'nome' => $user->getNome(),
                'sobrenome' => $user->getSobrenome(),
                'email' => $user->getEmail(),
                'endereco' => [
                    'estado' => $user->getEndereco()->getEstado(),
                    'cidade' => $user->getEndereco()->getCidade(),
                    'bairro' => $user->getEndereco()->getBairro(),
                    'rua' => $user->getEndereco()->getRua(),
                    'numero' => $user->getEndereco()->getNumero(),
                    'complemtento' => $user->getEndereco()->getComplemento()
                ],
                'telefones' => '/user/' . $user->getId() . '/phones'
            ];
        }

        return new JsonResponse($response);
    }
}
