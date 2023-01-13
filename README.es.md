# idSV

[This documentation is also available in English.](https://github.com/avalon-tech/idSV/blob/main/README.md)

## Introducción
idSV es una herramienta para la validación de números de identidad comunes en El Salvador, como el DUI y el NIT.

## Aviso importante
Desde el 17 de diciembre de 2021, los DUIs son NITs válidos para personas naturales, por lo que cualquier DUI es un NIT válido. Esto significa que puede usar el mismo número para ambas validaciones en el contexto de una persona natural (es decir, una persona con DUI).

Las personas jurídicas no se ven afectadas por este cambio, por lo que aún debe usar la validación de NIT para ellas.

También hay una opción para anular esta funcionalidad en la biblioteca cuando sea necesario.

## Instalación
Puedes usar composer para instalar idSV en ty proyecto:

```bash
composer require avalontechsv/idSV
```

## Uso
```php
use avalontechsv\idSV\idSV;

$validator = new idSV();

// Validación de DUI
// Validar DUI en formato 00000000-0
var_dump($validator->isValidDUI('00000000-0')); // true
var_dump($validator->isValidDUI('00000000-1')); // false

// Validar DUI en formato 000000000
var_dump($validator->isValidDUI('000000000')); // true
var_dump($validator->isValidDUI('000000001')); // false

// Esta libraría automáticamente elimina los espacios en blanco.
// Esto es útil cuando estás validando la entrada del usuario.
var_dump($validator->isValidDUI(' 000000000 ')); // true

// Validación de NIT
// Validar NIT en formato 0000-000000-000-0
var_dump($validator->isValidNIT('0000-000000-000-0')); // true
var_dump($validator->isValidNIT('0000-000000-000-1')); // false

// Validar NIT en formato 0000000000000
var_dump($validator->isValidNIT('0000000000000')); // true
var_dump($validator->isValidNIT('0000000000001')); // false

// También se puede validar un DUI como NIT para personas naturales
var_dump($validator->isValidNIT('00000000-0')); // true
var_dump($validator->isValidNIT('00000000-1')); // false

// Esta libraría automáticamente elimina los espacios en blanco.
// Esto es útil cuando estás validando la entrada del usuario.
var_dump($validator->isValidNIT(' 0000000000000 ')); // true

// Los DUI y NIT también pueden ser nulos
var_dump($validator->isValidDUI(null)); // false
var_dump($validator->isValidNIT(null)); // false

// Formateo de DUI y NIT

// Formatear DUI en el formato 00000000-0
var_dump($validator->formatDUI('000000000')); // 00000000-0

// Cadenas más cortas se rellenan con ceros
var_dump($validator->formatDUI('00')); // 00000000-0

// Si un DUI ya está formateado, se devolverá como está
var_dump($validator->formatDUI('00000000-0')); // 00000000-0

// Si se intenta formatear un DUI inválido, se genera una excepción
try { $validator->formatDUI('000000001'); } catch (\Exception $e) { echo 'Exception: ' . $e->getMessage(); } // Exception: Invalid DUI

// Formatear NIT en el formato 0000-000000-000-0
var_dump($validator->formatNIT('00000000000000')); // 0000-000000-000-0

// Cadenas más cortas se rellenan con ceros
var_dump($validator->formatNIT('00')); // 0000-000000-000-0

// Si un NIT ya está formateado, se devolverá como está
var_dump($validator->formatNIT('0000-000000-000-0')); // 0000-000000-000-0

// Los DUIs válidos se formatearán como DUIs en el formateador de NIT por defecto
var_dump($validator->formatNIT('000000000')); // 00000000-0

// Se puede desactivar el formateo de DUIs como NITs
var_dump($validator->formatNIT('000000000', false)); // 0000-000000-000-0

// El rellenado de ceros también se aplica a los NIT con formateo de DUI desactivado
var_dump($validator->formatNIT('00', false)); // 0000-000000-000-0

// Si se intenta formatear un NIT inválido, se genera una excepción
try { $validator->formatNIT('0000000000001'); } catch (\Exception $e) { echo 'Exception: ' . $e->getMessage() . '\n';  } // Exception: Invalid NIT
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