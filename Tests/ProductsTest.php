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
		
		$this->assertInternalType('array', $this->products->search('love'));
	}
}
?>