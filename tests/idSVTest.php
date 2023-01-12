<?php

namespace avalontechsv;

use PHPUnit\Framework\TestCase;

class idSVTest extends TestCase {
        public function testInstantiationOfidSV() {
                $validator = new idSV();
                $this->assertInstanceOf(idSV::class, $validator);
        }

        public function testValidatorReturnsTrueForValidDUIWithDash() {
                $validator = new idSV();
                $this->assertTrue($validator->isValidDUI('00000000-0'));
        }

        public function testValidatorReturnsTrueForValidDUIWithoutDash() {
                $validator = new idSV();
                $this->assertTrue($validator->isValidDUI('000000000'));
        }

        public function testValidatorReturnsFalseForInvalidDUIWithDash() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidDUI('00000000-1'));
        }

        public function testValidatorReturnsFalseForInvalidDUIWithoutDash() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidDUI('000000001'));
        }

        public function testValidatorReturnsFalseForEmptyDUI() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidDUI(''));
        }

        public function testValidatorReturnsTrueForValidDUIWithSpaces() {
                $validator = new idSV();
                $this->assertTrue($validator->isValidDUI(' 00000000-0 '));
        }

        public function testValidatorReturnsFalseForInvalidDUIWithSpaces() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidDUI(' 00000000-1 '));
        }

        public function testValidatorReturnsFalseForDUIWithLetters() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidDUI('00000000-A'));
        }

        public function testValidatorReturnsFalseForDUIWithMoreThan10Characters() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidDUI('0000000000'));
        }

        public function testValidatorReturnsFalseForDUIWithLessThan9Characters() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidDUI('00000000'));
        }

        public function testValidatorReturnsTrueForValidNITWithDash() {
                $validator = new idSV();
                $this->assertTrue($validator->isValidNIT('0000-000000-000-0'));
        }

        public function testValidatorReturnsTrueForValidNITWithoutDash() {
                $validator = new idSV();
                $this->assertTrue($validator->isValidNIT('00000000000000'));
        }

        public function testValidatorReturnsFalseForInvalidNITWithDash() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidNIT('0000-000000-000-1'));
        }

        public function testValidatorReturnsFalseForInvalidNITWithoutDash() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidNIT('00000000000001'));
        }

        public function testValidatorReturnsFalseForEmptyNIT() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidNIT(''));
        }

        public function testValidatorReturnsTrueForValidNITWithSpaces() {
                $validator = new idSV();
                $this->assertTrue($validator->isValidNIT(' 0000-000000-000-0 '));
        }

        public function testValidatorReturnsFalseForInvalidNITWithSpaces() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidNIT(' 0000-000000-000-1 '));
        }

        public function testValidatorReturnsFalseForNITWithLetters() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidNIT('0000-000000-000-A'));
        }

        public function testValidatorReturnsTrueForValidNITinDUIFormat() {
                $validator = new idSV();
                $this->assertTrue($validator->isValidNIT('000000000'));
        }

        public function testValidatorReturnsFalseForInvalidNITinDUIFormat() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidNIT('000000001'));
        }

        public function testValidatorReturnsFalseForNITWithMoreThan17Characters() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidNIT('00000000000000000'));
        }

        public function testValidatorReturnsFalseForNullDUI() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidDUI(null));
        }

        public function testValidatorReturnsFalseForNullNIT() {
                $validator = new idSV();
                $this->assertFalse($validator->isValidNIT(null));
        }
}