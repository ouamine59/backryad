<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
class SecurityController extends AbstractController
{
    #[Route('/admin/login', name: 'app_admin_login', methods: ['POST'])]
public function login(#[CurrentUser] $user = null): Response
{
    if (null === $user) {
        return $this->json([
            'message' => 'missing credentials',
        ], Response::HTTP_UNAUTHORIZED);
    }

    // Vérifier le rôle "ROLE_ADMIN" dans la liste des rôles de l'utilisateur
    if (!in_array('ROLE_ADMIN', $user->getRoles(), true)) {
        return $this->json([
            'message' => 'Access denied. Admin role required.',
        ], Response::HTTP_FORBIDDEN);
    }

    // Retourner les informations utilisateur sans générer de token
    return $this->json([
        'user' => $user->getUserIdentifier(),
        'id' => $user->getId()
    ]);
}

    #[Route('/client/login', name: 'app_client_login', methods: ['POST'])]   
    public function login_client(#[CurrentUser] $user = null): Response
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        if (!in_array('ROLE_USER', $user->getRoles(), true)) {
            return $this->json([
                'message' => 'Access denied. User role required.',
            ], Response::HTTP_FORBIDDEN);
        }

        return $this->json([
            'path' => 'src/Controller/SecurityController.php',
            'user'  => $user->getUserIdentifier(),
            'id' => $user ? $user->getId() : null
        ]);
    }
}
