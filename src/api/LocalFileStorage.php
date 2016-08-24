<?php

namespace API\File;

class LocalFileStorage implements FileStorageInterface{
	private $filename;
	
	public function __construct($filename){
		$this->SetFilename($filename);
	}
	
	public function SetFilename($filename){
		$this->filename = $filename;
	}
	
	public function GetFilename($filename){
		return $this->filename;
	}
	
	public function getFile(){
		if(!is_file($this->filename)){
			throw new \Exception('File "'.$this->filename.'" do not exists!');
		}
		return file_get_contents($this->filename);
	}
	
	public function setFile($content){
		if(!is_dir(dirname($this->filename))){
			throw new \Exception('Dir "'.dirname($this->filename).'" do not exists!');
		}
		return (file_put_contents($this->filename,$content) !== false)?(true):(false);
	}
	
	public function removeFile(){
		if(!is_file($this->filename)){
			throw new \Exception('File "'.$this->filename.'" do not exists!');
		}
		return unlink($this->filename);
	}
}

?>