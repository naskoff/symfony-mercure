<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Attribute\Route;

final class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(HubInterface $hub, Request $request): JsonResponse
    {
        $hub->publish(
            new Update(
                topics: 'all-topic-handler',
                data: json_encode($request->headers->all()),
                private: false,
            )
        );

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/HomepageController.php',
        ]);
    }
}
