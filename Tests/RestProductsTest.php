<?php
use GuzzleHttp\Client;

class RestProductsTest extends PHPUnit_Framework_TestCase{
	
	protected static $client;
	
	public static function setUpBeforeClass(){
		self::$client = new \GuzzleHttp\Client(['cookies' => true,'base_uri' => 'http://localhost/Feelings-Store/api/']);
		
	}
	
	/** @test */
	public function get_products_list(){
		$response = self::$client->get('products/get_list');
		$this->assertEquals(200, $response->getStatusCode());
		$responseBody = json_decode($response->getBody(),true);
		$this->assertInternalType('array',$responseBody);
		$this->assertEquals('success', $responseBody['result']);
	}
	
}
?>