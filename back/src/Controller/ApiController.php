<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\HashTable;
class ApiController
{
    
    #[Route('/calculate',name :"calculate",methods:['POST'])]
    
    public function calculateShipping(Request $request ): JsonResponse
    {       
            $body = json_decode($request->getContent(), true);
            
            $table = new HashTable();
            $carrier =  $table->get($body['carrier']);
            if ($carrier == null){
                return new JsonResponse([
                    'error' => 'Carrier not found'
                ], Response::HTTP_NOT_FOUND );
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