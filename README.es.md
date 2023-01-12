# idSV

[This documentation is also available in English.](https://github.com/avalon-tech/idSV/blob/main/README.md)

## Introducción
idSV es una herramienta para la validación de números de identidad comunes en El Salvador, como el DUI y el NIT.

## Aviso importante
Desde el 17 de diciembre de 2021, los DUIs son NITs válidos para personas naturales, por lo que cualquier DUI es un NIT válido. Esto significa que puede usar el mismo número para ambas validaciones en el contexto de una persona natural (es decir, una persona con DUI).

Las personas jurídicas no se ven afectadas por este cambio, por lo que aún debe usar la validación de NIT para ellas.

## Instalación
Puedes usar composer para instalar idSV en ty proyecto:

```bash
composer require avalontechsv/idSV
```

## Uso
```php
use avalontechsv\idSV;

$validator = new idSV;

// Validación de DUI
// Validar DUI en el formato 00000000-0
$validator->isValidDUI('00000000-0'); // true
$validator->isValidDUI('00000000-1'); // false

// Validar DUI en el formato 000000000
$validator->isValidDUI('000000000'); // true
$validator->isValidDUI('000000001'); // false

// La biblioteca eliminará automáticamente los espacios en blanco.
// Esto es útil cuando está validando entradas de un usuario.
$validator->isValidDUI(' 000000000 '); // true

// Validación de NIT
// Validar NIT en el formato 0000-000000-000-0
$validator->isValidNIT('0000-000000-000-0'); // true
$validator->isValidNIT('0000-000000-000-1'); // false

// Validar NIT en el formato 0000000000000
$validator->isValidNIT('0000000000000'); // true
$validator->isValidNIT('0000000000001'); // false

// También puede validar NITs para personas naturales
// en el formato DUI.
$validator->isValidNIT('00000000-0'); // true
$validator->isValidNIT('00000000-1'); // false

// La biblioteca eliminará automáticamente los espacios en blanco.
// Esto es útil cuando está validando entradas de un usuario.
$validator->isValidNIT(' 0000000000000 '); // true
```
## Pruebas
Puedes ejecutar las pruebas con PHPUnit:

```bash
./vendor/bin/phpunit
```

O puedes usar el comando `test` de composer:

```bash
composer test
```

## Agradecimientos
- [gmelendezcr](https://github.com/gmelendezcr) por el algoritmo y el [gist](https://gist.github.com/gmelendezcr/3609421) para calcular el dígito validador en los DUI. Escrito en Javascript.
- [MauricioG](https://www.svcommunity.org/forum/programacioacuten/como-calcular-digito-verificador-del-dui-y-nit/45/) por el algoritmo para calcular el dígito validador en los NIT. Escrito en Visual FoxPro.

## Licencia
Este paquete es software de código abierto bajo la licencia [GNU General Public License v3.0](https://opensource.org/licenses/GPL-3.0).