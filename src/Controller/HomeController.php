<?php

namespace App\Controller;

use App\Service\Query;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(Query $query): JsonResponse
    {
        $data = $query->fetchBooks();
        return $this->json($data, $status = 200, $headers = [], $context = []);
    }
}
