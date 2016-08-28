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
                'product' => 'happiness',
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
	public function remove_product_in_cart(){
		$response = self::$client->get('cart/remove_product',[
			'query' => [
                'product' => 'happiness'
            ]
		]);
		$this->assertEquals(200, $response->getStatusCode());
		$responseBody = json_decode($response->getBody(),true);
		$this->assertInternalType('array',$responseBody);
		$this->assertEquals('success', $responseBody['result']);
	}
	
	/** @test */
	public function add_shipping_address_in_cart(){
		$response = self::$client->get('cart/add_shipping',[
			'query' => [
                'street' => 'Rua Japuruchita, 175',
				'postalcode' => '03388150',
				'city' => 'Sao Paulo',
				'state' => 'SP',
				'country' => 'Brasil'
            ]
		]);
		$this->assertEquals(200, $response->getStatusCode());
		$responseBody = json_decode($response->getBody(),true);
		$this->assertInternalType('array',$responseBody);
		$this->assertEquals('success', $responseBody['result']);
	}
	
	/** @test */
	public function add_billing_address_in_cart(){
		$response = self::$client->get('cart/add_billing',[
			'query' => [
                'street' => 'Rua Japuruchita, 175',
				'postalcode' => '03388150',
				'city' => 'Sao Paulo',
				'state' => 'SP',
				'country' => 'Brasil'
            ]
		]);
		$this->assertEquals(200, $response->getStatusCode());
		$responseBody = json_decode($response->getBody(),true);
		$this->assertInternalType('array',$responseBody);
		$this->assertEquals('success', $responseBody['result']);
	}
	
	/** @test */
	public function remove_shipping(){
		$response = self::$client->get('cart/remove_shipping');
		$this->assertEquals(200, $response->getStatusCode());
		$responseBody = json_decode($response->getBody(),true);
		$this->assertInternalType('array',$responseBody);
		$this->assertEquals('success', $responseBody['result']);
	}
	
	/** @test */
	public function remove_billing_address_in_cart(){
		$response = self::$client->get('cart/remove_billing');
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
		$this->assertInternalType('array',$responseBody);
		$this->assertEquals('success', $responseBody['result']);
	}
	
	/** @test */
	public function get_total_of_products_in_the_cart(){
		$response = self::$client->get('cart/get_total');
		$this->assertEquals(200, $response->getStatusCode());
		$responseBody = json_decode($response->getBody(),true);
		$this->assertInternalType('array',$responseBody);
		$this->assertEquals('success', $responseBody['result']);
	}
}
?>