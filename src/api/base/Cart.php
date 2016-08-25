<?php
namespace API\Base;

use API\File\FileStorageFactory;
use API\Base\CartProduct;
use API\Base\Address;

class Cart{
	private $cartid;
	private $cart;
	private $cartApply;
	private $hash = "F33lg00d";
	private $cartPath = "cart/";
	
	public function __construct(){
		
		$this->GetCartID();
		$this->GetCart();
	}
	
	private function GetCartID(){
		
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if(array_key_exists('CARTID',$_SESSION) && !empty($_SESSION['CARTID'])){
			$this->cartid = $_SESSION['CARTID'];
		}else if(array_key_exists('CARTID',$_COOKIE) && !empty($_COOKIE['CARTID'])){
			$this->cartid = $_COOKIE['CARTID'];
			$_SESSION['CARTID'] = $_COOKIE['CARTID'];
		}else{
			$this->cartid = $this->NewCart();
			setcookie('CARTID',$this->cartid,time()+60*60*24*30);//last 30 days
			$_SESSION['CARTID'] = $this->cartid;
			
		}
	}
	
	private function NewCart(){
		return hash('md5',$this->hash.session_id().rand(1,100000));
	}
	
	private function GetCart(){
		$Storage = FileStorageFactory::create($this->cartPath.$this->cartid);
		try
		{
			$this->cart = json_decode($Storage->getFile(),true);
			$this->attachCartProducts();
			$this->attachAddresses();
		}
		catch(\Exception $e)
		{
			$this->cart = array(
				'cart' => array(),
				'shipping' => array(),
				'billing' => array()
			);
			$Storage->setFile(json_encode($this->cart));
		}
	}
	
	private function attachCartProducts(){
		foreach($this->cart['cart'] as $product => $data){
			$this->attachCartProduct($product,$data['quantity']);
		}
	}
	
	protected function attachCartProduct($product,$quantity){
		$this->cart['cart'][$product] = new CartProduct($product,$quantity);
	}
	
	protected function detachCartProduct($product){
		if(!array_key_exists($product,$this->cart['cart'])){
			throw new \Exception('Product "'.$product.'" is not in the cart!');
		}
		unset($this->cart['cart'][$product]);
	}
	
	private function attachAddresses(){
		$this->attachAddressByType('shipping');
		$this->attachAddressByType('billing');
	}
	
	private function attachAddressByType($type){
		if(!is_array($this->cart[$type])){
			throw new \Exception('Address type "'.$type.'" is not valid!');
		}
		
		if(count($this->cart[$type]) > 0){
			$this->attachAddress($type,$this->cart[$type]['street'],$this->cart[$type]['postalcode'],$this->cart[$type]['city'],$this->cart[$type]['state'],$this->cart[$type]['country']);
		}
	}
	
	protected function attachAddress($type,$street,$postalcode,$city,$state,$country){
		$this->cart[$type] = new Address($street,$postalcode,$city,$state,$country);
	}
		
	protected function detachAddress($type){
		if(!array_key_exists($type,$this->cart)){
			throw new \Exception('Address type "'.$type.'" is not valid!');
		}
		$this->cart[$type] = array();
	}
	private function applyAddress($type){
		if(is_object($this->cartApply[$type])){
			$this->cartApply[$type] = array(
				'street' => $this->cartApply[$type]->GetStreet(),
				'postalcode' => $this->cartApply[$type]->GetPostalcode(),
				'city' => $this->cartApply[$type]->GetCity(),
				'state' => $this->cartApply[$type]->GetState(),
				'country' => $this->cartApply[$type]->GetCountry()
			);
		}
	}
	protected function apply(){
		$this->cartApply = $this->cart;
		foreach($this->cartApply['cart'] as $cartProduct){
			$this->cartApply['cart'][$cartProduct->GetProductKey()] = array(
				'quantity' => $cartProduct->GetQuantity()
			);
		}
		$this->applyAddress('shipping');
		$this->applyAddress('billing');
		
		$Storage = FileStorageFactory::create($this->cartPath.$this->cartid);
		if(!$Storage->setFile(json_encode($this->cartApply))){
			throw new \Exception('unable to save cart data!');
		}
		
		return $this->GetAllCart();
	}
	
	protected function GetAllCart(){
		$all_products_amount = 0;
		foreach($this->cartApply['cart'] as $product => $data){
			$this->cartApply['cart'][$product] = array_merge($this->cartApply['cart'][$product],$this->cart['cart'][$product]->GetProduct());
			$all_products_amount += $this->cartApply['cart'][$product]['total_amount'];
		}
		$this->cartApply['all_products_amount'] = $all_products_amount;
		
		return $this->cartApply;
	}
	
	
}
?>
