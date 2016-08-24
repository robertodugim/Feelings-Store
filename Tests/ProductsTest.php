<?php

use API\Base\Products;

class ProductsTest extends PHPUnit_Framework_TestCase{
	
	protected $products;
	
	public function setUp(){
		$this->products = new Products();
	}
	
	/** @test */
	public function return_products_in_json_format(){
		
		$this->assertInternalType('string', $this->products->getJson());
	}
	
	/** @test */
	public function return_products_in_array_format(){
		
		$this->assertInternalType('array', $this->products->getArray());
	}
	
	/** @test */
	public function search_a_product(){
		
		$product = $this->products->search('love');
		$this->assertInternalType('array', $product);
		
		$this->assertArrayHasKey('name', $product);
		$this->assertArrayHasKey('description', $product);
		$this->assertArrayHasKey('author', $product);
		$this->assertArrayHasKey('value', $product);
		$this->assertArrayHasKey('inStock', $product);
		
		$this->assertInternalType('string', $product['name']);
		$this->assertInternalType('string', $product['description']);
		$this->assertInternalType('string', $product['author']);
		$this->assertInternalType('float', $product['value']);
		$this->assertInternalType('int', $product['inStock']);
	}
}
?>