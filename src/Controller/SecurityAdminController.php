<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
class SecurityAdminController extends AbstractController
{
    #[Route('/admin/login', name: 'app_admin_login', methods: ['POST'])]   
    public function login(#[CurrentUser] $user = null): Response
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
                 'path' => 'src/Controller/SecurityController.php',
                'user'  => $user->getUserIdentifier(),
                'id' => $user ? $user->getId() : null
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

        return $this->json([
                 'path' => 'src/Controller/SecurityController.php',
                'user'  => $user->getUserIdentifier(),
                'id' => $user ? $user->getId() : null
        ]);

    }
}
