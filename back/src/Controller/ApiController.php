<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CompanyTable;

class ApiController
{
    public CompanyTable $table;

    public function __construct(CompanyTable $table)
    {
        $this->table = $table;
    }

    #[Route('/carriers', name: "carriers", methods: ['GET'])]
    public function getCarriers(): JsonResponse
    {
        return new JsonResponse($this->table->getAll());
    }

    #[Route('/calculate', name: "calculate", methods: ['POST'])]
    public function calculateShipping(Request $request): JsonResponse
    {
        
        $body = json_decode($request->getContent(), true);
        
        $carrier = $this->table->get($body['carrier']);
        if ($carrier === null) {
            return new JsonResponse(['error' => 'Carrier not found'], 404);
        }
        if($body['weightKg'] <= 0){
            return new JsonResponse(['error' => 'wrong weight'], 400);
        }
        $cost = $carrier->calculateShipping($body['weightKg']);

        return new JsonResponse([
            'carrier' => $body['carrier'],
            'weightKg' => $body['weightKg'],
            'shippingCost' => $cost,
            'currency' => 'USD'
        ]);
    }
}