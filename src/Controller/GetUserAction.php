<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Phone;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetUserAction
{   
    #[Route("/users/{id}", methods: ["GET"])]
    public function __invoke(EntityManagerInterface $entityManager, int $id): Response
    {   
        $user = $entityManager->find(User::class, $id);

        if(null === $user){
            return new JsonResponse(['error' => 'Usuário não encontrado'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse([
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
            'telefones' => '/user/'.$user->getId().'/phones'
        ]);
    }
}