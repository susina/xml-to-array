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

use org\bovigo\vfs\vfsStream;
use Susina\XmlToArray\FileConverter;

it('instantiate the correct object via static method', function () {
    expect(FileConverter::create())->toBeInstanceOf(FileConverter::class);
});

it('converts an XML file to an array', function (string $xml, array $expected) {
    $file = vfsStream::newFile("test_file.xml")->at($this->getRoot())->setContent($xml);
    $actual = FileConverter::create()->convert($file->url());

    expect($expected)->toBe($actual);
})->with('Xml');

it('try to convert a not existent file', function () {
    $converter = new FileConverter();
    $converter->convert('vfs://root/notexistent.xml');
})->throws(\RuntimeException::class, 'The file `vfs://root/notexistent.xml` does not exist.');

it('try to convert a not readable file', function () {
    $file = vfsStream::newFile('notreadable.xml', 200)->at($this->getRoot())->setContent("<root></root>");
    FileConverter::create()->convert($file->url());
})->throws(\RuntimeException::class, 'The file `vfs://root/notreadable.xml` is not readable: do you have the correct permissions?');
