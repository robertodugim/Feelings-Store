<?php

namespace API\File;

/**
  * Interface to "Type"FileStorage Classes 
  *
  * @package API\File
  */
interface FileStorageInterface{
	
	/**
	  * Get a content of predefined file
	  *
	  *@return string Return the file data content
	  */
	public function getFile();
	
	/**
	  * Set the content of predefined file
	  *
	  *@param string $content file data content
	  *
	  *@return bool True if the file was created, False if the file was not created
	  */
	public function setFile($content);
	
	/**
	  * Remove a predefined file
	  *
	  *@return bool True if the file was removed, False if the file was not removed
	  */
	public function removeFile();
}

?>