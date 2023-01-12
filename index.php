<?php

use avalontechsv\idSV;

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