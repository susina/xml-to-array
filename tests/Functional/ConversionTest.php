<?php declare(strict_types=1);
/*
 * Copyright (c) Cristiano Cinotti 2024.
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *  http://www.apache.org/licenses/LICENSE-2.0
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

use Susina\XmlToArray\Converter;

it('converts real life XML files', function (string $file) {
    $phpFile = __DIR__ . "/../Fixtures/$file.php";
    $xmlFile = __DIR__ . "/../Fixtures/$file.xml";

    $expected = include($phpFile);
    $actual = Converter::create()->convertFile($xmlFile);

    expect($actual)->toBe($expected);
})->with(['joomla', 'propel']);
