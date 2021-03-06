<?php
namespace API\Base;

use API\File\FileStorageFactory;
/**
  * List of Products in the storage
  *
  * @package API\Base
  */
class Products{
	/**
	  * @var string Should contain filename with path. default value: "basic/products.json"
	  */
	private $filename = "basic/products.json";
	/**
	  * @var array Should contain the array of products
	  */
	private $products;
	/**
	  * @var string Should contain the json of products
	  */
	private $json;
	/**
	  * @var LocalFileStorage The class object returned by FileStorageFactory::create()
	  * @see \API\File\FileStorageFactory
	  */
	private $storage;
	
	/**
	  * Class construct Set properties storage,json and products
	  *
	  *Instace the file storage class object to storage property. Get the file content and include into json property. Decode json into property products.
	  *
	  *@uses \API\File\FileStorageFactory::create()
	  *@see \API\File\FileStorageFactory
	  *
	  *@throws \Exception if products is not a array
	  *@return void
	  */
	public function __construct(){
		$this->storage = FileStorageFactory::create($this->filename);
		$this->json = $this->storage->getFile();
		$this->products = json_decode($this->json,true);
		if(!is_array($this->products)){
			throw new \Exception('Not valid Products!');
		}
	}
	
	/**
	  * Get the products json
	  *
	  *@return string products json
	  */
	public function getJson(){
		return $this->json;
	}
	
	/**
	  * Get the products array
	  *
	  *@return array products array
	  */
	public function getArray(){
		return $this->products;
	}
	
	/**
	  * Search a Product by its key
	  *
	  *@param string $productKey product Key
	  *
	  *@throws \Exception if product key not exists in the products list
	  *@return array product array
	  */
	public function search($productKey){
		if(!array_key_exists($productKey,$this->products)){
			throw new \Exception('Product do not exists!');
		}
		return $this->products[$productKey];
	}
	
}

?>