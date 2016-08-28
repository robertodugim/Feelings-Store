<?php
namespace API\Base;
/**
  * Define Address object
  *
  * Used in Cart class
  *
  * @see Cart
  * @package API\Base
  */
class Address{
	/**
	  * @var string Should contain a Street Address
	  */
	private $street;
	
	/**
	  * @var string Should contain a Postalcode
	  */
	private $postalcode;
	
	/**
	  * @var string Should contain a City
	  */
	private $city;
	
	/**
	  * @var string Should contain a State
	  */
	private $state;
	
	/**
	  * @var string Should contain a Country
	  */
	private $country;
	
	/**
	  * Class construct will call method this->SetAddress to set the Address class properties
	  *
	  *@param string $street the street name
	  *@param string $postalcode the postalcode name
	  *@param string $city the city name
	  *@param string $state the state name
	  *@param string $country the country name
	  *
	  *@uses API\Base\Address::SetAddress() Set the Address class properties
	  *
	  *@return void
	  */
	public function __construct($street,$postalcode,$city,$state,$country){
		$this->SetAddress($street,$postalcode,$city,$state,$country);
	}
	
	/**
	  * Set the Address class properties
	  *
	  *@param string $street the street name
	  *@param string $postalcode the postalcode name
	  *@param string $city the city name
	  *@param string $state the state name
	  *@param string $country the country name
	  *
	  *@uses API\Base\Address::SetStreet()
	  *@uses API\Base\Address::SetPostalcode()
	  *@uses API\Base\Address::SetCity()
	  *@uses API\Base\Address::SetState()
	  *@uses API\Base\Address::SetCountry()
	  *
	  *@return void
	  */
	public function SetAddress($street,$postalcode,$city,$state,$country){
		$this->SetStreet($street);
		$this->SetPostalcode($postalcode);
		$this->SetCity($city);
		$this->SetState($state);
		$this->SetCountry($country);
	}
	
	/**
	  * Set the Street property
	  *
	  *@param string $street the street name
	  *
	  *@throws \Exception if street param is empty
	  *@return void
	  */
	public function SetStreet($street){
		if(empty($street)){
			throw new \Exception('The street value is empty!');
		}
		$this->street = $street;
	}
	
	/**
	  * Set the postalcode property
	  *
	  *@param string $postalcode the postalcode name
	  *
	  *@throws \Exception if postalcode param is empty
	  *@return void
	  */
	public function SetPostalcode($postalcode){
		if(empty($postalcode)){
			throw new \Exception('The postalcode value is empty!');
		}
		$this->postalcode = $postalcode;
	}
	
	/**
	  * Set the city property
	  *
	  *@param string $city the city name
	  *
	  *@throws \Exception if city param is empty
	  *@return void
	  */
	public function SetCity($city){
		if(empty($city)){
			throw new \Exception('The city value is empty!');
		}
		$this->city = $city;
	}
	
	/**
	  * Set the state property
	  *
	  *@param string $state the state name
	  *
	  *@throws \Exception if state param is empty
	  *@return void
	  */
	public function SetState($state){
		if(empty($state)){
			throw new \Exception('The state value is empty!');
		}
		$this->state = $state;
	}
	
	/**
	  * Set the country property
	  *
	  *@param string $country the country name
	  *
	  *@throws \Exception if country param is empty
	  *@return void
	  */
	public function SetCountry($country){
		if(empty($country)){
			throw new \Exception('The country value is empty!');
		}
		$this->country = $country;
	}
	
	/**
	  * Get the street content
	  *
	  *@return string street content
	  */
	public function GetStreet(){
		return $this->street;
	}
	
	/**
	  * Get the postalcode content
	  *
	  *@return string postalcode content
	  */
	public function GetPostalcode(){
		return $this->postalcode;
	}
	
	/**
	  * Get the city content
	  *
	  *@return string city content
	  */
	public function GetCity(){
		return $this->city;
	}
	
	/**
	  * Get the state content
	  *
	  *@return string state content
	  */
	public function GetState(){
		return $this->state;
	}

	/**
	  * Get the country content
	  *
	  *@return string country content
	  */
	public function GetCountry(){
		return $this->country;
	}
}

?>