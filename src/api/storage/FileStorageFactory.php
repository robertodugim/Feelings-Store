<?php

namespace API\File;

use API\File\LocalFileStorage;

/**
  * File Storage Factory
  *
  * Responsable to define with "Type"FileStorage Class will be use in the API
  *
  * @package API\File
  */
class FileStorageFactory{
	
	/**
	  * Static function to instace the predefined file storage class
	  *
	  * The class object return can be changed to accomplish a clound file storage requirement
	  *
	  *@param string $filename the filename with dir(e.g:basic/products.json)
	  *
	  *@return LocalFileStorage A LocalFileStorage class object
	  */
	public static function create($filename){
		return new LocalFileStorage($filename);
	}
	
}
?>