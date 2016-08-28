<?php
namespace API\Base;

use API\Base\Products;
use API\Base\CartManager;

/**
  * Manage the API requests and format the return
  *
  *@see Products
  *@see CartManager
  *
  * @package API\Base
  */
class ManageAPI{
	/**
	  * @var array Should contain the response array for the request
	  */
	private $response;
	/**
	  * @var array Should contain query string pass by GET
	  */
	private $data;
	/**
	  * @var Products Should contain Products object if the request module is products/
	  */
	private $products;
	/**
	  * @var CartManager Should contain CartManager object if the request module is cart/
	  */
	private $cart;
	
	/**
	  * Start the API request process and set the data property
	  *
	  *@param array $data The GET 
	  *
	  *@uses API\Base\ManageAPI::SetReponse()
	  *@uses API\Base\ManageAPI::IniLoader()
	  *
	  *@return void
	  */
	public function __construct($data){
		$this->SetReponse();
		$this->data = $data;
		$this->IniLoader();
	}
	/**
	  * Set the response array format
	  *
	  *@return void
	  */
	private function SetReponse(){
		$this->response = array(
			"result" => "none",//will be error or success
			"error" => "none",
			"data" => null
		);
	}
	/**
	  * Retun the response array
	  *
	  *@return array return the response
	  */
	public function GetResponse(){
		return $this->response;
	}
	
	/**
	  * try to make the API request process. If fail set response['result'] as error and pass the error message to response['error']
	  *
	  *@uses API\Base\ManageAPI::Loader()
	  *
	  *@return array return the response
	  */
	private function IniLoader(){
		try
		{
			$this->Loader();
		}
		catch(\Exception $e)
		{
			$this->response['result'] = "error";         
			$this->response['error'] = $e->GetMessage();    
		}
	}
	/**
	  * Check if the params product and quantity was sent be the API request
	  *
	  *
	  *@throws \Exception product or quantity is not set
	  *@return void
	  */
	private function CheckProductQuantity($data){
		if(!isset($data['product']) || !isset($data['quantity'])){
			throw new \Exception('Fields Product and Quantity must be filled!');
		}
	}
	
	/**
	  * Check if the params product was sent be the API request
	  *
	  *
	  *@throws \Exception product is not set
	  *@return void
	  */
	private function CheckProduct($data){
		if(!isset($data['product'])){
			throw new \Exception('Field Product must be filled!');
		}
	}
	
	/**
	  * Check if the params street,postalcode,city,state and country was sent be the API request
	  *
	  *
	  *@throws \Exception any address field is not set
	  *@return void
	  */
	private function CheckAddressFields($data){
		if(!isset($data['street']) || !isset($data['postalcode']) || !isset($data['city']) || !isset($data['state']) || !isset($data['country'])){
			throw new \Exception('Fields Street, Postalcode, City, State and Country must be filled!');
		}
	}
	
	/**
	  * Perform the request
	  *
	  * Choose the module and method, verify require field and set the response['data']
	  *
	  *@throws \Exception if module or method is not set or not exists
	  *@return void
	  */
	private function Loader(){
		
		if(!array_key_exists('module',$this->data)){
			throw new \Exception('Module is empty!');
		}
		
		if(!array_key_exists('method',$this->data)){
			throw new \Exception('Method is empty!');
		}
		
		switch ($this->data['module']) {
			case 'products':
				$this->products = new Products();
				switch ($this->data['method']) {
					case 'get_list':
						$this->response['data'] = $this->products->getArray();
						break;
					case 'get_product':
						$this->CheckProduct($this->data);
						$this->response['data'] = $this->products->search($this->data['product']);
						break;
					default:
						throw new \Exception('Invalid Method!');
				}
				break;
			case 'cart':
				$this->cart = new CartManager();
				switch ($this->data['method']) {
					case 'get_cart':
						$this->response['data'] = $this->cart->getCartDetails();
						break;
					case 'get_total':
						$this->response['data'] = $this->cart->getCartTotal();
						break;
					case 'add_product':
						$this->CheckProductQuantity($this->data);
						$this->response['data'] = $this->cart->addProduct($this->data['product'],$this->data['quantity']);
						break;
					case 'change_product':
						$this->CheckProductQuantity($this->data);
						$this->response['data'] = $this->cart->changeProduct($this->data['product'],$this->data['quantity']);
						break;
					case 'remove_product':
						$this->CheckProduct($this->data);
						$this->response['data'] = $this->cart->removeProduct($this->data['product']);
						break;
					case 'add_shipping':
						$this->CheckAddressFields($this->data);
						$this->response['data'] = $this->cart->addShipping($this->data['street'],$this->data['postalcode'],$this->data['city'],$this->data['state'],$this->data['country']);
						break;
					case 'add_billing':
						$this->CheckAddressFields($this->data);
						$this->response['data'] = $this->cart->addBilling($this->data['street'],$this->data['postalcode'],$this->data['city'],$this->data['state'],$this->data['country']);
						break;
					case 'remove_shipping':
						$this->response['data'] = $this->cart->removeShipping();
						break;
					case 'remove_billing':
						$this->response['data'] = $this->cart->removeBilling();
						break;
					default:
						throw new \Exception('Invalid Method!');
				}
				break;
			default:
				throw new \Exception('Invalid Module!');
		}
		$this->response['result'] = "success";
	}
	
}
?>