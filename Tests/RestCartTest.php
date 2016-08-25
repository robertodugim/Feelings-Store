<?php
use GuzzleHttp\Client;

class RestCartTest extends PHPUnit_Framework_TestCase{
	
	protected static $client;
	
	public static function setUpBeforeClass(){
		self::$client = new \GuzzleHttp\Client(['cookies' => true,'base_uri' => 'http://localhost/Feelings-Store/api/']);
		
	}
	
	/** @test */
	public function add_product_in_cart(){
		$response = self::$client->get('cart/add_product',[
			'query' => [
                'product' => 'love',
				'quantity' => 1
            ]
		]);
		$this->assertEquals(200, $response->getStatusCode());
		$responseBody = json_decode($response->getBody(),true);
		$this->assertInternalType('array',$responseBody);
		$this->assertEquals('success', $responseBody['result']);
	}
	
	/** @test */
	public function add_more_one_product_in_cart(){
		$response = self::$client->get('cart/add_product',[
			'query' => [
                'product' => 'lovi',
				'quantity' => 2
            ]
		]);
		$this->assertEquals(200, $response->getStatusCode());
		$responseBody = json_decode($response->getBody(),true);
		$this->assertInternalType('array',$responseBody);
		$this->assertEquals('success', $responseBody['result']);
	}
	
	/** @test */
	public function change_product_quantity_in_cart(){
		$response = self::$client->get('cart/change_product',[
			'query' => [
                'product' => 'love',
				'quantity' => 4
            ]
		]);
		$this->assertEquals(200, $response->getStatusCode());
		$responseBody = json_decode($response->getBody(),true);
		$this->assertInternalType('array',$responseBody);
		$this->assertEquals('success', $responseBody['result']);
	}
	
	/** @test */
	public function get_cart_details(){
		$response = self::$client->get('cart/get_cart');
		$this->assertEquals(200, $response->getStatusCode());
		$responseBody = json_decode($response->getBody(),true);
		print_r($responseBody);
		$this->assertInternalType('array',$responseBody);
		$this->assertEquals('success', $responseBody['result']);
	}
	
}
?>