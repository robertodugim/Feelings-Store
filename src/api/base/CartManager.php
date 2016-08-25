<?php
namespace API\Base;

use API\Base\Cart;

class CartManager extends Cart{
	public function getCartDetails(){
		return $this->apply();
	}
	
	public function addProduct($product,$quantity){
		$this->attachCartProduct($product,$quantity);
		return $this->apply();
	}
	
	public function changeProduct($product,$quantity){
		$this->attachCartProduct($product,$quantity);
		return $this->apply();
	}
	
	public function removeProduct($product){
		$this->detachCartProduct($product);
		return $this->apply();
	}
	
	public function addShipping($street,$postalcode,$city,$state,$country){
		$this->attachAddress('shipping',$street,$postalcode,$city,$state,$country);
		return $this->apply();
	}
	
	public function addBilling($street,$postalcode,$city,$state,$country){
		$this->attachAddress('billing',$street,$postalcode,$city,$state,$country);
		return $this->apply();
	}
	
	public function removeShipping(){
		$this->detachAddress('shipping');
		return $this->apply();
	}
	
	public function removeBilling(){
		$this->detachAddress('billing');
		return $this->apply();
	}
}
?>