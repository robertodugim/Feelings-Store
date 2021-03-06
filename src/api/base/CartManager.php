<?php
namespace API\Base;

use API\Base\Cart;
/**
  * Manage the requests for cart changes
  *
  *@see Cart
  *
  * @package API\Base
  */
class CartManager extends Cart{
	
	/**
	  * Get Cart Details
	  *
	  *@uses API\Base\Cart::apply()
	  *@see Cart
	  *
	  *@return array Cart Detail With products and addresses
	  */
	public function getCartDetails(){
		return $this->apply();
	}
	
	/**
	  * Get Quantity of products in the cart
	  *
	  *@uses API\Base\Cart::apply()
	  *@see Cart
	  *
	  *@return int Quantity of products in the cart
	  */
	public function getCartTotal(){
		$cart = $this->apply();
		return count($cart['cart']);
	}
	
	/**
	  * Add Product in the cart
	  *
	  *@param string $product Product Key 
	  *@param int $quantity Product Quantity
	  *
	  *@uses API\Base\Cart::attachCartProduct()
	  *@uses API\Base\Cart::apply()
	  *@see Cart
	  *
	  *@return array Cart Detail With products and addresses
	  */	
	public function addProduct($product,$quantity){
		$this->attachCartProduct($product,$quantity);
		return $this->apply();
	}
	
	/**
	  * Change Product in the cart
	  *
	  *@param string $product Product Key 
	  *@param int $quantity Product Quantity
	  *
	  *@uses API\Base\Cart::attachCartProduct()
	  *@uses API\Base\Cart::apply()
	  *@see Cart
	  *
	  *@return array Cart Detail With products and addresses
	  */	
	public function changeProduct($product,$quantity){
		$this->attachCartProduct($product,$quantity);
		return $this->apply();
	}
	
	/**
	  * Remove Product in the cart
	  *
	  *@param string $product Product Key 
	  *
	  *@uses API\Base\Cart::detachCartProduct()
	  *@uses API\Base\Cart::apply()
	  *@see Cart
	  *
	  *@return array Cart Detail With products and addresses
	  */	
	public function removeProduct($product){
		$this->detachCartProduct($product);
		return $this->apply();
	}
	
	/**
	  * Add Shipping Address in the cart
	  *
	  *@param string $street the street name
	  *@param string $postalcode the postalcode name
	  *@param string $city the city name
	  *@param string $state the state name
	  *@param string $country the country name
	  *
	  *@uses API\Base\Cart::attachAddress()
	  *@uses API\Base\Cart::apply()
	  *@see Cart
	  *
	  *@return array Cart Detail With products and addresses
	  */	
	public function addShipping($street,$postalcode,$city,$state,$country){
		$this->attachAddress('shipping',$street,$postalcode,$city,$state,$country);
		return $this->apply();
	}
	
	/**
	  * Add Billing Address in the cart
	  *
	  *@param string $street the street name
	  *@param string $postalcode the postalcode name
	  *@param string $city the city name
	  *@param string $state the state name
	  *@param string $country the country name
	  *
	  *@uses API\Base\Cart::attachAddress()
	  *@uses API\Base\Cart::apply()
	  *@see Cart
	  *
	  *@return array Cart Detail With products and addresses
	  */	
	public function addBilling($street,$postalcode,$city,$state,$country){
		$this->attachAddress('billing',$street,$postalcode,$city,$state,$country);
		return $this->apply();
	}
	
	/**
	  * Remove Shipping Address in the cart
	  *
	  *@uses API\Base\Cart::detachAddress()
	  *@uses API\Base\Cart::apply()
	  *@see Cart
	  *
	  *@return array Cart Detail With products and addresses
	  */	
	public function removeShipping(){
		$this->detachAddress('shipping');
		return $this->apply();
	}
	
	/**
	  * Remove Billing Address in the cart
	  *
	  *@uses API\Base\Cart::detachAddress()
	  *@uses API\Base\Cart::apply()
	  *@see Cart
	  *
	  *@return array Cart Detail With products and addresses
	  */	
	public function removeBilling(){
		$this->detachAddress('billing');
		return $this->apply();
	}
}
?>