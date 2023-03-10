# idSV

[Esta documentación tambien está disponible en español.](https://github.com/avalon-tech/idSV/blob/main/README.es.md)

## Introduction
idSV is a tool for validation of common identity numbers in El Salvador, such as DUI and NIT.

## Important notice
Since December 17th, 2021, DUIs are valid NITs for natural persons, so any DUI is a valid NIT. This means that you can use the same number for both validations in the context of a natural person (i.e. a person with a DUI).

Legal entities are not affected by this change, so you should still use the NIT validation for them.

There is also an option to override this functionality in the library when required.

## Installation
You can use composer to install idSV in your project:

```bash
composer require avalontechsv/idSV
```

## Usage
```php
use avalontechsv\idSV\idSV;

$validator = new idSV();

// DUI validation
// Validate DUI in the format 00000000-0
var_dump($validator->isValidDUI('00000000-0')); // true
var_dump($validator->isValidDUI('00000000-1')); // false

// Validate DUI in the format 000000000
var_dump($validator->isValidDUI('000000000')); // true
var_dump($validator->isValidDUI('000000001')); // false

// The library will automatically trim the input.
// This is useful when you are validating user input.
var_dump($validator->isValidDUI(' 000000000 ')); // true

// NIT validation
// Validate NIT in the format 0000-000000-000-0
var_dump($validator->isValidNIT('0000-000000-000-0')); // true
var_dump($validator->isValidNIT('0000-000000-000-1')); // false

// Validate NIT in the format 0000000000000
var_dump($validator->isValidNIT('0000000000000')); // true
var_dump($validator->isValidNIT('0000000000001')); // false

// Also, you can validate NITs for natural persons
// in the DUI format.
var_dump($validator->isValidNIT('00000000-0')); // true
var_dump($validator->isValidNIT('00000000-1')); // false

// The library will automatically trim the input.
// This is useful when you are validating user input.
var_dump($validator->isValidNIT(' 0000000000000 ')); // true

// DUI and NIT can also be null
var_dump($validator->isValidDUI(null)); // false
var_dump($validator->isValidNIT(null)); // false

// DUI and NIT formatting

// Format DUI in the format 000000000
var_dump($validator->formatDUI('000000000')); // 00000000-0

// Shorter strings will be padded with zeros
var_dump($validator->formatDUI('00')); // 00000000-0

// If a DUI was already formatted, it will be returned as is
var_dump($validator->formatDUI('00000000-0')); // 00000000-0

// Invalid DUIs generate an exception
try { $validator->formatDUI('000000001'); } catch (\Exception $e) { echo 'Exception: ' . $e->getMessage(); } // Exception: Invalid DUI

// Format NIT in the format 0000000000000
var_dump($validator->formatNIT('00000000000000')); // 0000-000000-000-0

// Shorter strings will be padded with zeros
var_dump($validator->formatNIT('00')); // 0000-000000-000-0

// If a NIT was already formatted, it will be returned as is
var_dump($validator->formatNIT('0000-000000-000-0')); // 0000-000000-000-0

// Valid DUIs will be formatted as DUI in the NIT formatter by default
var_dump($validator->formatNIT('000000000')); // 00000000-0

// You can force the NIT formatter to disallow DUIs too
var_dump($validator->formatNIT('000000000', false)); // 0000-000000-000-0

// Padding is also applied to NITs
var_dump($validator->formatNIT('00', false)); // 0000-000000-000-0

// Invalid NITs generate an exception
try { $validator->formatNIT('0000000000001'); } catch (\Exception $e) { echo 'Exception: ' . $e->getMessage() . '\n';  } // Exception: Invalid NIT
```
```
## Testing
You can run the tests with PHPUnit:

```bash
./vendor/bin/phpunit
```

Or you can run the `test` script with composer:

```bash
composer test
```

## Acknowledgements
- [gmelendezcr](https://github.com/gmelendezcr) for the algorithm and [gist](https://gist.github.com/gmelendezcr/3609421) to calculate the check digit in DUIs. Written in Javascript.
- [MauricioG](https://www.svcommunity.org/forum/programacioacuten/como-calcular-digito-verificador-del-dui-y-nit/45/) for the algorithm to calculate the check digit in NITs. Written in Visual FoxPro.

## License
This package is open-sourced software licensed under the [GNU General Public License v3.0](https://opensource.org/licenses/GPL-3.0).