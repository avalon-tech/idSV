<?php

use avalontechsv\idSV\idSV;

require_once 'vendor/autoload.php';

$validator = new idSV();

// DUI validation
// Validate DUI in the format 00000000-0
echo '$validator->isValidDUI(\'00000000-0\') -> '; var_dump($validator->isValidDUI('00000000-0')); // true
echo '$validator->isValidDUI(\'00000000-1\') -> '; var_dump($validator->isValidDUI('00000000-1')); // false

// Validate DUI in the format 000000000
echo '$validator->isValidDUI(\'000000000\') -> '; var_dump($validator->isValidDUI('000000000')); // true
echo '$validator->isValidDUI(\'000000001\') -> '; var_dump($validator->isValidDUI('000000001')); // false

// The library will automatically trim the input.
// This is useful when you are validating user input.
echo '$validator->isValidDUI(\' 000000000 \') -> ' ; var_dump($validator->isValidDUI(' 000000000 ')); // true

// NIT validation
// Validate NIT in the format 0000-000000-000-0
echo '$validator->isValidNIT(\'0000-000000-000-0\') -> '; var_dump($validator->isValidNIT('0000-000000-000-0')); // true
echo '$validator->isValidNIT(\'0000-000000-000-0\') -> '; var_dump($validator->isValidNIT('0000-000000-000-1')); // false

// Validate NIT in the format 0000000000000
echo '$validator->isValidNIT(\'0000000000000\') -> '; var_dump($validator->isValidNIT('0000000000000')); // true
echo '$validator->isValidNIT(\'0000000000001\') -> '; var_dump($validator->isValidNIT('0000000000001')); // false

// Also, you can validate NITs for natural persons
// in the DUI format.
echo '$validator->isValidNIT(\'00000000-0\') -> '; var_dump($validator->isValidNIT('00000000-0')); // true
echo '$validator->isValidNIT(\'00000000-1\') -> '; var_dump($validator->isValidNIT('00000000-1')); // false

// The library will automatically trim the input.
// This is useful when you are validating user input.
echo '$validator->isValidNIT(\' 0000000000000 \') -> '; var_dump($validator->isValidNIT(' 0000000000000 ')); // true

// DUI and NIT can also be null
echo '$validator->isValidDUI(null) -> '; var_dump($validator->isValidDUI(null)); // false
echo '$validator->isValidNIT(null) -> '; var_dump($validator->isValidNIT(null)); // false

// DUI and NIT formatting

// Format DUI in the format 000000000
echo '$validator->formatDUI(\'000000000\') -> '; var_dump($validator->formatDUI('000000000')); // 00000000-0

// If a DUI was already formatted, it will be returned as is
echo '$validator->formatDUI(\'00000000-0\') -> '; var_dump($validator->formatDUI('00000000-0')); // 00000000-0

// Invalid DUIs generate an exception
echo '$validator->formatDUI(\'000000001\') -> ';
try { $validator->formatDUI('000000001'); } catch (\Exception $e) { echo 'Exception: ' . $e->getMessage() . '\n'; } // Exception: Invalid DUI

// Format NIT in the format 0000000000000
echo '$validator->formatNIT(\'00000000000000\') -> '; var_dump($validator->formatNIT('00000000000000')); // 0000-000000-000-0

// If a NIT was already formatted, it will be returned as is
echo '$validator->formatNIT(\'0000-000000-000-0\') -> '; var_dump($validator->formatNIT('0000-000000-000-0')); // 0000-000000-000-0

// Valid DUIs will be formatted as DUI in the NIT formatter by default
echo '$validator->formatNIT(\'000000000\') -> '; var_dump($validator->formatNIT('000000000')); // 00000000-0

// You can force the NIT formatter to disallow DUIs too
echo '$validator->formatNIT(\'000000000\', false) -> '; var_dump($validator->formatNIT('000000000'), false); // 0000-000000-000-0

// Invalid NITs generate an exception
echo '$validator->formatNIT(\'0000000000001\') -> ';
try { $validator->formatNIT('0000000000001'); } catch (\Exception $e) { echo 'Exception: ' . $e->getMessage() . '\n';  } // Exception: Invalid NIT