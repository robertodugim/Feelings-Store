<?php
namespace API\Base;

use API\Base\Products;

class CartProduct{
	private $quantity;
	private $productKey;
	private $product;
	private $products;
	public function __construct($productKey,$quantity){
		$this->products = new Products();
		
		$this->SetQuantity($quantity);
		$this->SetProduct($productKey);
	}
	
	public function SetQuantity($quantity){
		if(!is_int($quantity)){
			throw new \Exception('The quantity must be a integer value!');
		}
		$this->quantity = $quantity;
	}
	
	private function SetProduct($productKey){
		$this->productKey = $productKey;
		$this->product = $this->products->search($this->productKey);
		$this->product['total_amount'] = $this->product['value'] * $this->quantity;
	}
	
	public function GetQuantity(){
		return $this->quantity;
	}
	
	public function GetProductKey(){
		return $this->productKey;
	}
	
	public function GetProduct(){
		return $this->product;
	}
}

?>