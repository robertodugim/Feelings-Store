<?php

namespace API\File;

/**
  * Perform a local file storage
  *
  * Class Choose in case of require a local file storage
  *
  * @package API\File
  */
class LocalFileStorage implements FileStorageInterface{
	
	/**
	  * Filename with dir.
	  *
	  * Exemple basic/products.json.
	  * The initial path allways be the local Dir of this file (e.g: C:\www\feelings\src\api\storage\)
	  *@var string Filename with dir (e.g: basic/products.json).
	  */
	private $filename;
	
	/**
	  * Class construct will call method this->SetFilename to set the filename property
	  *
	  *@param string $filename the filename with dir(e.g:basic/products.json)
	  *
	  **@uses API\File\LocalFileStorage::SetFilename() Set the filename property
	  *
	  *@return void
	  */
	public function __construct($filename){
		$this->SetFilename($filename);
	}
	
	/**
	  * Set the filename property
	  *
	  *@param string $filename the filename with dir(e.g:basic/products.json)
	  *
	  *@return void
	  */
	public function SetFilename($filename){
		$this->filename = __DIR__ . "/" .  $filename;
	}
	
	/**
	  * Class used to get the filename property
	  *
	  *@param string $filename the filename with dir(e.g:basic/products.json)
	  *
	  *@return string The filename property
	  */
	public function GetFilename($filename){
		return $this->filename;
	}
	
	/**
	  * Get a content of predefined file
	  *
	  *@throws \Exception if the file not exists
	  *@return string Return the file data content
	  */
	public function getFile(){
		if(!is_file($this->filename)){
			throw new \Exception('File "'.$this->filename.'" do not exists!');
		}
		return file_get_contents($this->filename);
	}
	
	/**
	  * Set the content of predefined file
	  *
	  *@param string $content file data content
	  *
	  *@throws \Exception if the filename dir not exists
	  *@return bool True if the file was created, False if the file was not created	  
	  */
	public function setFile($content){
		if(!is_dir(dirname($this->filename))){
			throw new \Exception('Dir "'.dirname($this->filename).'" do not exists!');
		}
		return (file_put_contents($this->filename,$content) !== false)?(true):(false);
	}
	
	/**
	  * Remove a predefined file
	  *
	  *@throws \Exception if the filename dir not exists
	  *@return bool True if the file was removed, False if the file was not removed
	  */
	public function removeFile(){
		if(!is_file($this->filename)){
			throw new \Exception('File "'.$this->filename.'" do not exists!');
		}
		return unlink($this->filename);
	}
}

?>