<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Phone;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DoctrineRelationsController extends AbstractController
{
    /**
     * @Route("/one-to-one")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function oneToOne(EntityManagerInterface $entityManager)
    {
        $user = new User();
        $user->setNome("Diego");
        $user->setSobrenome("Almeida");
        $user->setEmail("diego.almeida@outlook.com");
        $entityManager->persist($user);

        $address = new Address();
        $address->setEstado("MG");
        $address->setCidade("Betim");
        $address->setBairro("Ingá");
        $address->setRua("Rua 1");
        $address->setNumero("100");
        $address->setComplemento("Casa");
        $address->setUser($user);
        $entityManager->persist($address);

        $entityManager->flush();

        return new Response(sprintf(
            'Usuário inserido com o id %d e Endereço inserido com o id %d',
            $user->getId(),
            $address->getId()
        ));
    }

    /**
     * @Route("/one-to-many")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function oneToMany(EntityManagerInterface $entityManager)
    {
        /**
         * @var User $user
         */
        $user = $entityManager->find(User::class, 2);

        $telefone = new Phone();
        $telefone->setCodigoArea(31);
        $telefone->setNumero("3531-2900");
        $telefone->setUser($user);
        // dd($user->getTelefones());
        $entityManager->persist($telefone);
        $entityManager->flush();
        // dd($entityManager->contains($user), $entityManager->contains($telefone));

        return new Response(sprintf(
            'Telefone inserido com o id %d ',
            $telefone->getId()
        ));

    }

}
