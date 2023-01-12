# idSV

[Esta documentación tambien está disponible en español.](https://github.com/avalon-tech/idSV/blob/main/README.es.md)

## Introduction
idSV is a tool for validation of common identity numbers in El Salvador, such as DUI and NIT.

## Important notice
Since December 17th, 2021, DUIs are valid NITs for natural persons, so any DUI is a valid NIT. This means that you can use the same number for both validations in the context of a natural person (i.e. a person with a DUI).

Legal entities are not affected by this change, so you should still use the NIT validation for them.

## Installation
You can use composer to install idSV in your project:

```bash
composer require avalontechsv/idSV
```

## Usage
```php
use avalontechsv\idSV;

$validator = new idSV;

// DUI validation
// Validate DUI in the format 00000000-0
$validator->isValidDUI('00000000-0'); // true
$validator->isValidDUI('00000000-1'); // false

// Validate DUI in the format 000000000
$validator->isValidDUI('000000000'); // true
$validator->isValidDUI('000000001'); // false

// The library will automatically trim the input.
// This is useful when you are validating user input.
$validator->isValidDUI(' 000000000 '); // true

// NIT validation
// Validate NIT in the format 0000-000000-000-0
$validator->isValidNIT('0000-000000-000-0'); // true
$validator->isValidNIT('0000-000000-000-1'); // false

// Validate NIT in the format 0000000000000
$validator->isValidNIT('0000000000000'); // true
$validator->isValidNIT('0000000000001'); // false

// Also, you can validate NITs for natural persons
// in the DUI format.
$validator->isValidNIT('00000000-0'); // true
$validator->isValidNIT('00000000-1'); // false

// The library will automatically trim the input.
// This is useful when you are validating user input.
$validator->isValidNIT(' 0000000000000 '); // true
```
## Testing
You can run the tests with PHPUnit:

```bash
./vendor/bin/phpunit
```

## Acknowledgements
- [gmelendezcr](https://github.com/gmelendezcr) for the algorithm and [gist](https://gist.github.com/gmelendezcr/3609421) to calculate the check digit in DUIs. Written in Javascript.
- [MauricioG](https://www.svcommunity.org/forum/programacioacuten/como-calcular-digito-verificador-del-dui-y-nit/45/) for the algorithm to calculate the check digit in NITs. Written in Visual FoxPro.

## License
This package is open-sourced software licensed under the [GNU General Public License v3.0](https://opensource.org/licenses/GPL-3.0).