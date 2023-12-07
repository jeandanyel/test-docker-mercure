<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

class MercureController extends AbstractController
{
    #[Route('/mercure', name: 'app_mercure')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!'
        ]);
    }

    #[Route('/mercure/listen', name: 'app_listen')]
    public function listen(): Response
    {
        return $this->render('mercure/listen.html.twig');
    }

    #[Route('/mercure/publish', name: 'app_mercure_publish')]
    public function publish(HubInterface $hub): Response
    {
        $update = new Update(
            'https://example.com/books/1',
            json_encode([
                'status' => 'success',
                'date' => (new \DateTime())->format('Y-m-d H:i:s')
            ]),
            true
        );

        $hub->publish($update);

        return new Response('published!');
    }
}
