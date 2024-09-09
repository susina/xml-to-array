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
use Susina\XmlToArray\Exception\ConverterException;
use Susina\XmlToArray\Converter;

beforeEach(function () {
    $this->converter = new Converter();
});

it('instantiate the correct class, via static constructor', function () {
    expect(Converter::create())->toBeInstanceOf(Converter::class);
});

it('converts xml to array', function (string $xml, array $expected) {
    $actual = $this->converter->convert($xml);
    expect($actual)->toBe($expected);
})->with('Xml');

it('converts xml with inclusion', function (string $xmlLoad, string $xmlInclude, array $expected) {
    vfsStream::newFile('testconvert_include.xml')->at($this->getRoot())->setContent($xmlInclude);
    $actual = $this->converter->convert($xmlLoad);
    expect($actual)->toBe($expected);
})->with('Inclusion');

it('converts an invalid xml', function () {
    $invalidXml = <<< INVALID_XML
No xml
only plain text
---------
INVALID_XML;
    $this->converter->convert($invalidXml);
})->throws(ConverterException::class, "An error occurred while parsing XML string:
 - Fatal 4: Start tag expected, '<' not found
");

it('finds error in xml content', function () {
    $xmlWithError = <<< XML
<?xml version='1.0' standalone='yes'?>
<movies>
 <movie>
  <titles>Star Wars</title>
 </movie>
 <movie>
  <title>The Lord Of The Rings</title>
 </movie>
</movies>
XML;
    $this->converter->convert($xmlWithError);
})->throws(ConverterException::class, "An error occurred while parsing XML string:
 - Fatal 76: Opening and ending tag mismatch: titles line 4 and title
");

it('finds multiple errors in xml', function () {
    $xmlWithErrors = <<< XML
<?xml version='1.0' standalone='yes'?>
<movies>
 <movie>
  <titles>Star Wars</title>
 </movie>
 <movie>
  <title>The Lord Of The Rings</title>
 </movie>
</moviess>
XML;
    $this->converter->convert($xmlWithErrors);
})->throws(ConverterException::class, "Some errors occurred while parsing XML string:
 - Fatal 76: Opening and ending tag mismatch: titles line 4 and title
 - Fatal 76: Opening and ending tag mismatch: movies line 2 and moviess
");

it('converts Id attribute into an associative array key', function (string $xml, array $expected) {
    $actual = Converter::create()->convert($xml);
    expect($actual)->toBe($expected);
})->with('TestId');

it('converts an XML string without merging @attributes key', function (string $xml, array $expected) {
    $actual = Converter::create(['mergeAttributes' => false])->convert($xml);
    expect($actual)->toBe($expected);
})->with('XmlWithAttributes');

it('converts an XML string without preserving data types', function (string $xml, array $expected) {
    $actual = Converter::create(['typesAsString' => true])->convert($xml);
    expect($actual)->toBe($expected);
})->with('XmlNoTypes');

it('leave Id attribute as normal attribute', function (string $xml, array $expected) {
    $actual = Converter::create(['idAsKey' => false])->convert($xml);
    expect($actual)->toBe($expected);
})->with('NoIdConversion');

it('converts an XML string preserving the first tag', function () {
    $expected = [
        'breakfast_menu' => [
            'food' => [
                'name' => 'Waffles'
            ],
        ]
    ];

    $xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>
<breakfast_menu>
    <food>
        <name>Waffles</name>
    </food>
</breakfast_menu>";

    $actual = Converter::create(['preserveFirstTag' => true])->convert($xml);
    expect($actual)->toBe($expected);
});

it('converts an XML file to an array', function (string $xml, array $expected) {
    $file = vfsStream::newFile("test_file.xml")->at($this->getRoot())->setContent($xml);
    $actual = $this->converter->convertFile($file->url());

    expect($expected)->toBe($actual);
})->with('Xml');

it('try to convert a not existent file', function () {
    $this->converter->convertFile('vfs://root/notexistent.xml');
})->throws(\RuntimeException::class, 'The file `vfs://root/notexistent.xml` does not exist.');

it('try to convert a not readable file', function () {
    $file = vfsStream::newFile('notreadable.xml', 200)->at($this->getRoot())->setContent("<root></root>");
    $this->converter->convertFile($file->url());
})->throws(\RuntimeException::class, 'The file `vfs://root/notreadable.xml` is not readable: do you have the correct permissions?');
