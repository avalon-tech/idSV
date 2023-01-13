<?php

use avalontechsv\idSV\idSV;

require_once 'vendor/autoload.php';

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