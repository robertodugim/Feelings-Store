<?php

namespace API\File;

interface FileStorageInterface{
	
	public function getFile();
	public function setFile($content);
	public function removeFile();
}

?>