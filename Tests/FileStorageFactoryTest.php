<?php

use API\File\FileStorageFactory;

class FileStorageFactoryTest extends PHPUnit_Framework_TestCase{
	
	protected $storage;
	protected $filename;
	protected $content;
	
	public function setUp(){
		$this->filename = __DIR__ . "/../src/api/storage/cart/exemple.json";
		$this->storage = FileStorageFactory::create($this->filename);
		$this->content = "{FILE}";
	}
	
	/** @test */
	public function set_file_content(){
		
		$this->assertTrue($this->storage->setFile($this->content));
	}
	
	/** @test */
	public function retuns_file_content(){
		
		$this->assertInternalType('string', $this->storage->getFile());
	}
	
	/** @test */
	public function remove_file(){
		
		$this->assertTrue($this->storage->removeFile());
	}
}
?>