# R2Template [![CircleCI](https://circleci.com/gh/g737a6b/php-r2-template.svg?style=svg)](https://circleci.com/gh/g737a6b/php-r2-template)

PHP library to generate HTML document.

## 1. Examples of use

```php
$R2Template = new R2Template\R2Template("./templates");
$R2Template->set("var1", "foo");
$R2Template->set("var2", "bar");
$R2Template->display("echo_vars.php");// foo bar
```

## 2. Installation

### 2-1. Composer

Add a dependency to your project's `composer.json` file.

```json
{
	"require": {
		"g737a6b/php-r2-template": "*"
	}
}
```

## 3. License

[The MIT License](http://opensource.org/licenses/MIT)

Copyright (c) 2017 [Hiroyuki Suzuki](https://mofg.net)
