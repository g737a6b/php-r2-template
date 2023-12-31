# R2Template ![main](https://github.com/g737a6b/php-r2-template/workflows/main/badge.svg)

PHP template library.

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

### Install dependencies

```sh
docker run -it --rm -v $(pwd):/app composer:2.6.6 install
```

### Run tests

```sh
docker run -it --rm -v $(pwd):/app -w /app php:8.3 ./vendor/bin/phpunit ./tests
```

## License

[The MIT License](http://opensource.org/licenses/MIT)

Copyright (c) 2023 [Hiroyuki Suzuki](https://mofg-in-progress.com)
