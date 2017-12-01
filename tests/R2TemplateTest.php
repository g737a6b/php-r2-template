<?php
require(__DIR__."/../autoload.php");

use PHPUnit\Framework\TestCase;
use R2Template\R2Template;

class R2TemplateTest extends TestCase{
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
}
