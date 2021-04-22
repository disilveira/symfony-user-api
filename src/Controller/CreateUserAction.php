<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateUserAction
{

    #[Route("/users", methods: ["POST"])]
    public function __invoke(EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator, Request $request): Response
    {

        $user = $serializer->deserialize($request->getContent(), User::class, 'json');

        $errors = $validator->validate($user);

        if(count($errors) > 0){
            $violations = array_map(function(ConstraintViolationInterface $violation) {
                return [
                    'path' => $violation->getPropertyPath(),
                    'message' => $violation->getMessage()
                ];
            }, iterator_to_array($errors));

            $response = [
                'error' => 'As informações enviadas estão incorretas',
                'violations' => $violations
            ];

            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);

        }

        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse([
            'status' => 'ok',
            'id_usuario' => $user->getId()
        ], Response::HTTP_CREATED);
    }
}