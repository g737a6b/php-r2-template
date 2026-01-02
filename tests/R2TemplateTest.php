<?php

require(__DIR__."/../autoload.php");

use PHPUnit\Framework\TestCase;
use R2Template\R2Template;

class R2TemplateTest extends TestCase
{
    public function testSetAndGet()
    {
        $Template = new R2Template();
        $value = "string";
        $Template->set("var1", $value);
        $this->assertSame($value, $Template->get("var1"));
        $this->assertNull($Template->get("var2"));
    }

    public function testDisplayWithConstructor()
    {
        $path = __DIR__."/templates";
        $text = "Silence is golden.";
        $this->expectOutputString($text);
        $Template = new R2Template($path);
        $Template->set("var", $text);
        $result = $Template->display("echo_var.php");
        $this->assertTrue($result);
    }

    public function testDisplayWithoutConstructor()
    {
        $path = __DIR__."/templates";
        $text = "Silence is golden.";
        $this->expectOutputString($text);
        $Template = new R2Template();
        $Template->setPath($path);
        $Template->set("var", $text);
        $Template->display("echo_var.php");
    }

    public function testDisplayWithVars()
    {
        $path = __DIR__."/templates";
        $text = "Silence is golden.";
        $this->expectOutputString($text);
        $Template = new R2Template($path);
        $Template->display("echo_var.php", ["var" => $text]);
    }

    public function testGetContents()
    {
        $path = __DIR__."/templates";
        $text = "Silence is golden.";
        $Template = new R2Template($path);
        $Template->set("var", $text);
        $this->assertSame($text, $Template->getContents("echo_var.php"));
    }

    public function testGetContentsWithVars()
    {
        $path = __DIR__."/templates";
        $text = "Silence is golden.";
        $Template = new R2Template($path);
        $this->assertSame($text, $Template->getContents("echo_var.php", ["var" => $text]));
    }

    public function testClearVars()
    {
        $Template = new R2Template();
        $value = "string";
        $Template->set("var", $value);
        $this->assertSame($value, $Template->get("var"));
        $Template->clearVars();
        $this->assertNull($Template->get("var"));
    }

    public function testDisplayFileNotFound()
    {
        $path = __DIR__."/templates";
        $Template = new R2Template($path);

        $warningTriggered = false;
        set_error_handler(function ($errno, $errstr) use (&$warningTriggered) {
            if ($errno === E_USER_WARNING && mb_strpos($errstr, 'Template') !== false) {
                $warningTriggered = true;
            }
            return true;
        });

        $result = $Template->display("non_existent_file.php");

        restore_error_handler();

        $this->assertTrue($warningTriggered, 'Expected warning was not triggered');
        $this->assertFalse($result);
    }

    public function testDisplayWithUsePathFalse()
    {
        $absolutePath = __DIR__."/templates/echo_var.php";
        $text = "Silence is golden.";
        $this->expectOutputString($text);
        $Template = new R2Template();
        $Template->set("var", $text);
        $Template->display($absolutePath, [], false);
    }

    public function testGetContentsWithUsePathFalse()
    {
        $absolutePath = __DIR__."/templates/echo_var.php";
        $text = "Silence is golden.";
        $Template = new R2Template();
        $Template->set("var", $text);
        $this->assertSame($text, $Template->getContents($absolutePath, [], false));
    }

    public function testVariablesMerge()
    {
        $path = __DIR__."/templates";
        $text1 = "First value";
        $text2 = "Second value";
        $this->expectOutputString($text2);
        $Template = new R2Template($path);
        $Template->set("var", $text1);
        $Template->display("echo_var.php", ["var" => $text2]);
    }

    public function testPathWithTrailingSlash()
    {
        $path = __DIR__."/templates/";
        $text = "Silence is golden.";
        $this->expectOutputString($text);
        $Template = new R2Template($path);
        $Template->set("var", $text);
        $Template->display("echo_var.php");
    }

    public function testSetPathWithTrailingSlash()
    {
        $path = __DIR__."/templates/";
        $text = "Silence is golden.";
        $this->expectOutputString($text);
        $Template = new R2Template();
        $Template->setPath($path);
        $Template->set("var", $text);
        $Template->display("echo_var.php");
    }
}
