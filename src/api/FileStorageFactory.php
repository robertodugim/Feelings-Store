<?php

namespace API\File;

use API\File\LocalFileStorage;

class FileStorageFactory{
	
	public static function create($filename){
		return new LocalFileStorage($filename);
	}
	
}
?>