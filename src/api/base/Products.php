<?php
namespace API\Base;

use API\File\FileStorageFactory;

class Products{
	private $filename = "basic/products.json";
	private $products;
	private $json;
	private $storage;
	
	public function __construct(){
		$this->storage = FileStorageFactory::create($this->filename);
		$this->json = $this->storage->getFile();
		$this->products = json_decode($this->json,true);
		if(!is_array($this->products)){
			throw new \Exception('Not valid Products!');
		}
	}
	
	public function getJson(){
		return $this->json;
	}
	
	public function getArray(){
		return $this->products;
	}
	
	public function search($productKey){
		if(!array_key_exists($productKey,$this->products)){
			throw new \Exception('Product do not exists!');
		}
		return $this->products[$productKey];
	}
	
}

?>