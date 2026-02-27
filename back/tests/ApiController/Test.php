<?php

namespace App\Tests\ApiController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testCalculate(): void
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/calculate',
            [],                 
            [],
            ['CONTENT_TYPE' => 'application/json'], 
            json_encode([
                'carrier' => 'transcompany',
                'weightKg' => 10
            ])
        );

        $this->assertResponseIsSuccessful();
        $this->assertJsonResponse($client->getResponse());

        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('shippingCost', $data);

        $this->assertEquals(20, $data['shippingCost']); 

        
        $client->request(
            'POST',
            '/calculate',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'carrier' => 'transcompany',
                'weightKg' => 100
            ])
        );

        $this->assertResponseIsSuccessful();
        $this->assertJsonResponse($client->getResponse());

        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(100, $data['shippingCost']); 
       
        $client->request(
            'POST',
            '/calculate',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'], 
            json_encode([
                'carrier' => 'packgroup',
                'weightKg' => 10
            ])
        );

        $this->assertResponseIsSuccessful();
        $this->assertJsonResponse($client->getResponse());

        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('shippingCost', $data);

        $this->assertEquals(10, $data['shippingCost']);

        $client->request(
            'POST',
            '/calculate',
            [],                 
            [],
            ['CONTENT_TYPE' => 'application/json'], 
            json_encode([
                'carrier' => 'unknown',
                'weightKg' => 10
            ])
        );
        $this->assertResponseIsSuccessful();
   
        $client->request(
            'POST',
            '/calculate',
            [],                 
            [],
            ['CONTENT_TYPE' => 'application/json'], 
            json_encode([
                'carrier' => 'packgroup',
                'weightKg' => "safvsd"
            ])
        );
        $this->assertResponseIsSuccessful();
    }
    public function testGetCarriers():void{
        $client = static::createClient();

        $client->request('GET', '/carriers');

        $this->assertResponseIsSuccessful();
        $this->assertJsonResponse($client->getResponse());

        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
    }
    private function assertJsonResponse($response): void
    {
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            'Response is not JSON'
        );
    }
}