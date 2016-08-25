<?php
namespace API\Base;

class Address{
	private $street;
	private $postalcode;
	private $city;
	private $state;
	private $country;
	
	public function __construct($street,$postalcode,$city,$state,$country){
		$this->SetAddress($street,$postalcode,$city,$state,$country);
	}
	
	public function SetAddress($street,$postalcode,$city,$state,$country){
		$this->SetStreet($street);
		$this->SetPostalcode($postalcode);
		$this->SetCity($city);
		$this->SetState($state);
		$this->SetCountry($country);
	}
	
	public function SetStreet($street){
		if(empty($street)){
			throw new \Exception('The street value is empty!');
		}
		$this->street = $street;
	}
	
	public function SetPostalcode($postalcode){
		if(empty($postalcode)){
			throw new \Exception('The postalcode value is empty!');
		}
		$this->postalcode = $postalcode;
	}
	
	public function SetCity($city){
		if(empty($city)){
			throw new \Exception('The city value is empty!');
		}
		$this->city = $city;
	}
	
	public function SetState($state){
		if(empty($state)){
			throw new \Exception('The state value is empty!');
		}
		$this->state = $state;
	}
	
	public function SetCountry($country){
		if(empty($country)){
			throw new \Exception('The country value is empty!');
		}
		$this->country = $country;
	}
	
	public function GetStreet(){
		return $this->street;
	}
	
	public function GetPostalcode(){
		return $this->postalcode;
	}
	
	public function GetCity(){
		return $this->city;
	}
	
	public function GetState(){
		return $this->state;
	}

	public function GetCountry(){
		return $this->country;
	}
}

?>