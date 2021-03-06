<?php
namespace API\Base;

use API\File\FileStorageFactory;
use API\Base\CartProduct;
use API\Base\Address;
/**
  * Cart class object
  *
  * Manage the user Cart
  * is the parent class of the CartManager class
  *
  *@see CartManager
  *
  * @package API\Base
  */
class Cart{
	/**
	  * @var string Should contain cartid hash
	  */
	private $cartid;
	/**
	  * @var array Should contain cart detail array to be return
	  */
	private $cart;
	/**
	  * @var array Should contain cart information array to be included in the cart file
	  */
	private $cartApply;
	/**
	  * @var string Should contain the key word to cartid hash
	  */
	private $hash = "F33lg00d";
	/**
	  * @var string Should contain the cart storage folder/path. Default value is: "cart/"
	  */
	private $cartPath = "cart/";
	
	/**
	  * Class construct Get/Set the cartid and get the cart file content
	  *
	  *@uses API\Base\Cart::GetCartID() Set the cartid property
	  *@uses API\Base\Cart::GetCart() Get the cart file content or generate a new cart array
	  *
	  *@return void
	  */
	public function __construct(){
		
		$this->GetCartID();
		$this->GetCart();
	}
	/**
	  * Set the cartid property
	  *
	  * Get(Cookie or Session CARTID) or Set a new cartid
	  *
	  *@uses API\Base\Cart::NewCart() generate the cartid hash
	  *
	  *@return void
	  */
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
	/**
	  * Return a new cartid hash
	  *
	  * hash in md5 encripty. Format md5 (property hash . session id . rand number between 1 and 100000)
	  *
	  *@uses API\Base\Cart::NewCart() generate the cartid hash
	  *
	  *@return string cartid hash
	  */
	private function NewCart(){
		return hash('md5',$this->hash.session_id().rand(1,100000));
	}
	
	/**
	  * Set the cart property array
	  *
	  * Method will try to get the cart file and decode the json to a array into cart property than it will attach the Products and Address objects through the methods \API\Base\Cart::attachCartProducts() and \API\Base\Cart::attachAddresses()
	  * If the file not exists define cart property array and create a new cart file.
	  *
	  *@uses \API\File\FileStorageFactory::create()
	  *@uses \API\Base\Cart::attachCartProducts()
	  *@uses \API\Base\Cart::attachAddresses()
	  *@uses \API\Base\Cart::CheckCartFilename()
	  *@see \API\File\FileStorageFactory
	  
	  *@return string cartid hash
	  */
	private function GetCart(){
		$this->CheckCartFilename();
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
	
	/**
	  * Check if the cartid is valid
	  *
	  *@throws \Exception if the cartid have a dot
	  *@return void
	  */
	private function CheckCartFilename(){
		if(strpos($this->cartid,".") !== false){
			throw new \Exception('Cart Filename is not valid!');
		}
	}
	
	/**
	  * attach CartProduct object to all the products
	  *
	  * For each product in the cart attach a ProductCart object
	  *
	  *@user \API\Base\Cart::attachCartProduct()
	  *@see ProductCart
	  *
	  *@throws \Exception if the cartid have a dot
	  *@return void
	  */
	private function attachCartProducts(){
		foreach($this->cart['cart'] as $product => $data){
			$this->attachCartProduct($product,$data['quantity']);
		}
	}
	/**
	  * attach CartProduct object for a product in the cart
	  *
	  *@param string $product Product Key (e.g:love)
	  *@param int $quantity product quantity in the cart
	  *
	  *@see ProductCart
	  *
	  *@throws \Exception if quantity is not set OR $quantity is minor or equal than 0(zero) OR product key not exists in the products list
	  *@return void
	  */
	protected function attachCartProduct($product,$quantity){
		$this->cart['cart'][$product] = new CartProduct($product,$quantity);
	}
	
	/**
	  * detach CartProduct object for a product in the cart
	  *
	  *@param string $product Product Key (e.g:love)
	  *
	  *@throws \Exception if the product is not in the cart
	  *@return void
	  */
	protected function detachCartProduct($product){
		if(!array_key_exists($product,$this->cart['cart'])){
			throw new \Exception('Product "'.$product.'" is not in the cart!');
		}
		unset($this->cart['cart'][$product]);
	}
	
	/**
	  * Call methods to attach Addres object to shipping and billing addresses
	  *
	  *@user \API\Base\Cart::attachAddressByType()
	  *@see Address
	  *
	  *@throws \Exception if the Address type is invalid
	  *@return void
	  */
	private function attachAddresses(){
		$this->attachAddressByType('shipping');
		$this->attachAddressByType('billing');
	}
	
	/**
	  * Call methods to attach Address object to shipping or billing addresses
	  *
	  * Only attach Address object if the "type" address is not empty in the cart
	  *
	  *@param string $type Can be "shipping" or "billing"
	  *
	  *@user \API\Base\Cart::attachAddress()
	  *@see Address
	  *
	  *@throws \Exception if the Address type is invalid
	  *@return void
	  */
	private function attachAddressByType($type){
		if(!is_array($this->cart[$type])){
			throw new \Exception('Address type "'.$type.'" is not valid!');
		}
		
		if(count($this->cart[$type]) > 0){
			$this->attachAddress($type,$this->cart[$type]['street'],$this->cart[$type]['postalcode'],$this->cart[$type]['city'],$this->cart[$type]['state'],$this->cart[$type]['country']);
		}
	}
	
	/**
	  * Attach Address object to a addres type in the cart
	  *
	  *@param string $type Can be "shipping" or "billing"
	  *@param string $street 
	  *@param string $postalcode 
	  *@param string $city 
	  *@param string $state 
	  *@param string $country 
	  *
	  *@see Address
	  *
	  *@throws \Exception if any address field is empty
	  *@return void
	  */
	protected function attachAddress($type,$street,$postalcode,$city,$state,$country){
		$this->cart[$type] = new Address($street,$postalcode,$city,$state,$country);
	}
		
	/**
	  * detach Address object for a address type in the cart
	  *
	  *@param string $type Can be "shipping" or "billing"
	  *
	  *@throws \Exception if the address type is not in the cart
	  *@return void
	  */
	protected function detachAddress($type){
		if(!array_key_exists($type,$this->cart)){
			throw new \Exception('Address type "'.$type.'" is not valid!');
		}
		$this->cart[$type] = array();
	}
	/**
	  * Set the address type to array cartApply property
	  *
	  *@param string $type Can be "shipping" or "billing"
	  *
	  *@return void
	  */
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
	/**
	  * Set the array cartApply property 
	  *
	  * This method will save the json in the cart file
	  *
	  *@uses \API\File\FileStorageFactory::create()
	  *@uses \API\Base\Cart::applyAddress()
	  *@uses \API\Base\Cart::applyAddress()
	  *@uses \API\Base\Cart::GetAllCart()
	  *@see \API\File\FileStorageFactory
	  *
	  *@throws \Exception if its not possible to save the cart file
	  *@return array Array of the cart with products details and addresses
	  */
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
	/**
	  * Return Array of the cart with products details and addresses
	  *
	  *@return array Array of the cart with products details and addresses
	  */
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
