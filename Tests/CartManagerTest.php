<?php

use API\Base\CartManager;
session_start();
class CartManagerTest extends PHPUnit_Framework_TestCase{
	
	protected $cart;
	protected $product;
	protected $quantity;
	protected $newquantity;
	protected $street;
	protected $postalcode;
	protected $city;
	protected $state;
	protected $country;
	
	public function setUp(){
		
		$_SESSION['CARTID'] = 'test';//Persist Cart ID for tests
		$this->cart = new CartManager();
		$this->product = 'love';
		$this->quantity = 1;
		$this->newquantity = 4;
		
		$this->street = 'street';
		$this->postalcode = 'postalcode';
		$this->city = 'city';
		$this->state = 'state';
		$this->country = 'country';
	}
	
	
	
	/** @test */
	public function add_product_in_cart(){
		$this->assertInternalType('array', $this->cart->addProduct($this->product,$this->quantity));
	}
	
	/** @test */
	public function change_product_quantity_in_cart(){
		$this->assertInternalType('array', $this->cart->changeProduct($this->product,$this->newquantity));
	}
	
	/** @test */
	public function remove_product_in_cart(){
		$this->assertInternalType('array', $this->cart->removeProduct($this->product));
	}
	
	/** @test */
	public function add_shipping_address_in_cart(){
		$this->assertInternalType('array', $this->cart->addShipping($this->street,$this->postalcode,$this->city,$this->state,$this->country));
	}
	
	/** @test */
	public function add_billing_address_in_cart(){
		$this->assertInternalType('array', $this->cart->addBilling($this->street,$this->postalcode,$this->city,$this->state,$this->country));
	}
	
	/** @test */
	public function remove_shipping_address_in_cart(){
		$this->assertInternalType('array', $this->cart->removeShipping());
	}
	
	/** @test */
	public function remove_billing_address_in_cart(){
		$this->assertInternalType('array', $this->cart->removeBilling());
	}
	
	
	/** @test */
	public function return_products_in_cart(){
		$this->assertInternalType('array', $this->cart->getCartDetails());
	}
}

?>