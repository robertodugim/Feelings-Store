<?php
namespace API\Base;

use API\Base\Products;
use API\Base\CartManager;

class ManageAPI{
	private $response;
	private $data;
	private $products;
	private $cart;
	
	public function __construct($data){
		$this->SetReponse();
		$this->data = $data;
		$this->IniLoader();
	}
	private function SetReponse(){
		$this->response = array(
			"result" => "none",//will be error or success
			"error" => "none",
			"data" => null
		);
	}
	
	public function GetResponse(){
		return $this->response;
	}
	
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
						$this->response['data'] = $this->cart->addProduct($this->data['product'],$this->data['quantity']);
						break;
					case 'change_product':
						$this->response['data'] = $this->cart->changeProduct($this->data['product'],$this->data['quantity']);
						break;
					case 'remove_product':
						$this->response['data'] = $this->cart->removeProduct($this->data['product']);
						break;
					case 'add_shipping':
						$this->response['data'] = $this->cart->addShipping($this->data['street'],$this->data['postalcode'],$this->data['city'],$this->data['state'],$this->data['country']);
						break;
					case 'add_billing':
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