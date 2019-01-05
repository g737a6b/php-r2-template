<?php
require(__DIR__."/../autoload.php");

use PHPUnit\Framework\TestCase;
use R2Template\R2Template;

class R2TemplateTest extends TestCase{
	public function testSetAndGet(){
		$Template = new R2Template();
		$value = "string";
		$Template->set("var1", $value);
		$this->assertSame($value, $Template->get("var1"));
		$this->assertNull($Template->get("var2"));
	}

	public function testDisplayWithConstructor(){
		$path = __DIR__."/templates";
		$text = "Silence is golden.";
		$this->expectOutputString($text);
		$Template = new R2Template($path);
		$Template->set("var", $text);
		$Template->display("echo_var.php");
	}

	public function testDisplayWithoutConstructor(){
		$path = __DIR__."/templates";
		$text = "Silence is golden.";
		$this->expectOutputString($text);
		$Template = new R2Template();
		$Template->setPath($path);
		$Template->set("var", $text);
		$Template->display("echo_var.php");
	}

	public function testDisplayWithVars(){
		$path = __DIR__."/templates";
		$text = "Silence is golden.";
		$this->expectOutputString($text);
		$Template = new R2Template($path);
		$Template->display("echo_var.php", ["var" => $text]);
	}

	public function testGetContents(){
		$path = __DIR__."/templates";
		$text = "Silence is golden.";
		$Template = new R2Template($path);
		$Template->set("var", $text);
		$this->assertSame($text, $Template->getContents("echo_var.php"));
	}

	public function testGetContentsWithVars(){
		$path = __DIR__."/templates";
		$text = "Silence is golden.";
		$Template = new R2Template($path);
		$this->assertSame($text, $Template->getContents("echo_var.php", ["var" => $text]));
	}

	public function testClearVars(){
		$Template = new R2Template();
		$value = "string";
		$Template->set("var", $value);
		$this->assertSame($value, $Template->get("var"));
		$Template->clearVars();
		$this->assertNull($Template->get("var"));
	}
}
