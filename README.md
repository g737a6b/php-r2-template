# R2Template ![main](https://github.com/g737a6b/php-r2-template/workflows/main/badge.svg)

PHP library to generate HTML document.

## Examples of use

```php
$R2Template = new R2Template\R2Template("./templates");
$R2Template->set("var1", "foo");
$R2Template->set("var2", "bar");
$R2Template->display("echo_vars.php");// foo bar
```

## Installation

### Composer

Add a dependency to your project's `composer.json` file.

```json
{
	"require": {
		"g737a6b/php-r2-template": "*"
	}
}
```

## Development

### Run tests

```sh
docker run -it --rm -v $(pwd):/app composer:1.8 run-script tests
```

## License

[The MIT License](http://opensource.org/licenses/MIT)

Copyright (c) 2019 [Hiroyuki Suzuki](https://mofg.net)
