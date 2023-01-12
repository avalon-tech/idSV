<?php

namespace avalontechsv;

class idSV{
    /**
     * Check if a DUI is valid
     *
     * @param string $dui
     * @return bool
     */
    public function isValidDUI(?string $dui): bool
    {
        // DUI cannot be null
        if (is_null($dui)) {
            return false;
        }

        // DUI cannot be empty
        if (empty($dui)) {
            return false;
        }

        // Trim to remove spaces at the beginning and end of the string
        $dui = trim($dui);

        // DUI can be 9 or 10 characters long, depending if it has a dash
        if (strlen($dui) != 9 && strlen($dui) != 10) {
            return false;
        }

        // Remove dash from DUI
        $dui = str_replace('-', '', $dui);

        // DUI must be numeric
        if (!is_numeric($dui)) {
            return false;
        }

        // DUI must be 9 characters long
        if (strlen($dui) != 9) {
            return false;
        }

        // DUI must have a valid check digit
        $checkDigit = substr($dui, -1);

        $duiWithoutCheckDigit = substr($dui, 0, -1);

        $sum = 0;

        for ($i = 0; $i < strlen($duiWithoutCheckDigit); $i++) {
            $sum += $duiWithoutCheckDigit[$i] * (9 - $i);
        }

        $expectedCheckDigit = 10 - ($sum % 10);

        if ($expectedCheckDigit == 10) {
            $expectedCheckDigit = 0;
        }

        if ($checkDigit != $expectedCheckDigit) {
            return false;
        }

        return true;
    }

    /**
     * Check if a NIT is valid
     *
     * @param string $nit
     * @return bool
     */
    public function isValidNIT(?string $nit): bool
    {
        // Since December 17th, 2021, DUIs are valid NITs, so isValidDUI() can be used
        // if $nit is a DUI
        if ($this->isValidDUI($nit)) {
            return true;
        }

        // NIT cannot be null
        if (is_null($nit)) {
            return false;
        }

        // NIT cannot be empty
        if (empty($nit)) {
            return false;
        }

        // Trim to remove spaces at the beginning and end of the string
        $nit = trim($nit);

        // NIT can be 17 characters long, if it has dashes
        // NIT can be 14 characters long, if it doesn't have dashes
        // NIT can be 13 characters long, if it doesn't have dashes and the first digit is 0
        if (strlen($nit) != 13 && strlen($nit) != 14 && strlen($nit) != 17) {
            return false;
        }

        // Remove dashes from NIT
        $nit = str_replace('-', '', $nit);

        // NIT must be numeric
        if (!is_numeric($nit)) {
            return false;
        }

        // If NIT is 13 characters long, add a 0 at the beginning
        if (strlen($nit) == 13) {
            $nit = '0' . $nit;
        }

        // NIT must be 14 characters long now
        if (strlen($nit) != 14) {
            return false;
        }

        // Initialize variables
        $sum = 0;
        $calculatedCheckDigit = 0;
        $calculatedFactor = 0;

        // Validate if it's an old (<= 100) or new (>= 100) NIT
        if (intval(substr($nit, 10, 3)) <= 100) { // Old routine
            for ($i = 1; $i <= 13; $i++) {
                $sum += intval(substr($nit, $i - 1, 1)) * (15 - $i);
            }
            $calculatedCheckDigit = $sum % 11;
            if ($calculatedCheckDigit == 10) {
                $calculatedCheckDigit = 0;
            }
        } else { // New routine
            for ($i = 1; $i <= 13; $i++) {
                $calculatedFactor = (3 + (6 * floor(abs(($i + 4) / 6)))) - $i;
                $sum += intval(substr($nit, $i - 1, 1)) * $calculatedFactor;
            }
            $calculatedCheckDigit = $sum % 11;
            if ($calculatedCheckDigit > 1) {
                $calculatedCheckDigit = 11 - $calculatedCheckDigit;
            } else {
                $calculatedCheckDigit = 0;
            }
        }

        return $calculatedCheckDigit == intval(substr($nit, 13, 1));
    }
}