<?php

use API\File\FileStorageFactory;

class FileStorageFactoryTest extends PHPUnit_Framework_TestCase{
	
	protected $storage;
	protected $filename;
	protected $content;
	
	public function setUp(){
		$this->storage = FileStorageFactory::create();
		$this->filename = __DIR__ . "/../src/cart/exemple.json";
		$this->content = "{FILE}";
	}
	
	/** @test */
	public function set_file_content(){
		
		$this->assertTrue($this->storage->setFile($this->filename,$this->content));
	}
	
	/** @test */
	public function retuns_file_content(){
		
		$this->assertInternalType('string', $this->storage->getFile($this->filename));
	}
	
	/** @test */
	public function remove_file(){
		
		$this->assertTrue($this->storage->removeFile($this->filename));
	}
}
?>