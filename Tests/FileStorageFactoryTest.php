<?php

use API\File\FileStorageFactory;

class FileStorageFactoryTest extends PHPUnit_Framework_TestCase{
	
	protected $storage;
	protected $filename;
	
	public function setUp(){
		$this->storage = FileStorageFactory::create();
		$this->filename = __DIR__ . "/../src/cart/exemple.json";
	}
	
	/** @test */
	public function retuns_file_content(){
		
		$this->assertInternalType('string', $this->storage->getFile());
	}
}
?>