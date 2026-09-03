<?php

declare(strict_types=1);
/*
 * Copyright (c) Cristiano Cinotti 2024 - 2026.
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

namespace Susina\XmlToArray\Tests\Unit;

use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use Susina\XmlToArray\Exception\ConverterException;
use Susina\XmlToArray\Converter;
use Susina\XmlToArray\Tests\VfsTestCase;
use Susina\XmlToArray\Tests\XmlToArrayDataProvider;

class ConverterTest extends VfsTestCase
{
    private Converter $converter;
    public function setUp(): void
    {
        $this->converter = new Converter();
    }

    public function testStaticConstructor(): void
    {
        $this->assertInstanceOf(Converter::class, Converter::create());
    }

    #[DataProviderExternal(XmlToArrayDataProvider::class, 'xmlProvider')]
    public function testConvertXmlToArray(string $xml, array $expected): void
    {
        $actual = $this->converter->convert($xml);
        $this->assertSame($expected, $actual);
    }

    public function testConvertXmlWithInclusions(): void
    {
        $xmlLoad = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<database name=\"named\" defaultIdMethod=\"native\">
    <xi:include xmlns:xi=\"http://www.w3.org/2001/XInclude\" 
        href=\"{$this->getIncludedFile()->url()}\" xpointer=\"xpointer( /database/* )\" 
    />
</database>";
        $expected = [
            'name' => 'named',
            'defaultIdMethod' => 'native',
            'table' => [
                'name' => 'book',
                'phpName' => 'Book',
            ],
        ];
        $actual = $this->converter->convert($xmlLoad);

        $this->assertSame($expected, $actual);
    }

    public function testInvalidXmlThrowsException(): void
    {
        $this->expectException(ConverterException::class);
        $this->expectExceptionMessageIsOrContains(
            "An error occurred while parsing XML string:
 - Fatal 4: Start tag expected, '<' not found
",
        );
        $invalidXml = <<< INVALID_XML
No xml
only plain text
---------
INVALID_XML;

        $this->converter->convert($invalidXml);
    }

    public function testXmlContentErrorThrowsException(): void
    {
        $this->expectException(ConverterException::class);
        $this->expectExceptionMessageIsOrContains("An error occurred while parsing XML string:
 - Fatal 76: Opening and ending tag mismatch: titles line 4 and title
");
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
    }

    public function testMultipleXmlErrorsThrowsException(): void
    {
        $this->expectException(ConverterException::class);
        $this->expectExceptionMessageIsOrContains(
            "Some errors occurred while parsing XML string:
 - Fatal 76: Opening and ending tag mismatch: titles line 4 and title
 - Fatal 76: Opening and ending tag mismatch: movies line 2 and moviess
",
        );

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
    }

    #[DataProviderExternal(XmlToArrayDataProvider::class, 'xmlWithAttributesProvider')]
    public function testConvertXmlWithoutMergingAttributes(string $xml, array $expected): void
    {
        $actual = Converter::create(['mergeAttributes' => false])->convert($xml);
        $this->assertSame($expected, $actual);
    }

    #[DataProviderExternal(XmlToArrayDataProvider::class, 'xmlNoTypesProvider')]
    public function testConvertXmlWithoutPreservingDataTypes(string $xml, array $expected): void
    {
        $actual = Converter::create(['typesAsString' => true])->convert($xml);
        $this->assertSame($expected, $actual);
    }

    public function testConvertiXmlPreservingTheFirstTag(): void
    {
        $expected = [
            'breakfast_menu' => [
                'food' => [
                    'name' => 'Waffles',
                ],
            ],
        ];

        $xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>
<breakfast_menu>
    <food>
        <name>Waffles</name>
    </food>
</breakfast_menu>"
        ;
        $actual = Converter::create(['preserveFirstTag' => true])->convert($xml);

        $this->assertSame($expected, $actual);
    }

    #[DataProviderExternal(XmlToArrayDataProvider::class, 'convertAndSaveProvider')]
    public function testConvertXmlAndSavesIntoExistentFile(string $xml, array $expectedArray, string $expectedContent): void
    {
        $file = $this->createFile('saved_file.php');

        $this->converter->convertAndSave($xml, $file->url());
        $actual = include($file->url());

        $this->assertSame($expectedArray, $actual);
        $this->assertSame($expectedContent, $file->getContent());
        $this->assertSame($expectedContent, file_get_contents($file->url()));
    }

    #[DataProviderExternal(XmlToArrayDataProvider::class, 'convertAndSaveProvider')]
    public function testConvertAndSaveCreatesOutputFileIfNotExistent(string $xml, array $expectedArray, string $expectedContent): void
    {
        $this->converter->convertAndSave($xml, $this->root->url() . '/my_saved_file.php');

        $this->assertFileExists('vfs://root/my_saved_file.php');

        $actual = include($this->root->url() . '/my_saved_file.php');

        $this->assertSame($expectedArray, $actual);
        $this->assertSame($expectedContent, file_get_contents($this->root->url() . '/my_saved_file.php'));
    }

    public function testSaveInNotExistentDirectoryThrowsException(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageIs("The directory `vfs://root/my_dir` does not exist: you should create it before writing a file.");

        $xml = "<movies><movie><title>The Lord Of The Rings</title><starred>false</starred></movie></movies>";
        $this->converter->convertAndSave($xml, $this->root->url() . '/my_dir/my_array.php');
    }

    public function testSaveInNotWriteableDirectoryThrowsException(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageIs("It's impossible to write into `vfs://root/xml_dir` directory: do you have the correct permissions?");

        $dir = vfsStream::newDirectory('xml_dir', 000)->at($this->root);
        $xml = "<movies><movie><title>The Lord Of The Rings</title><starred>false</starred></movie></movies>";
        $this->converter->convertAndSave($xml, $dir->url() . '/my_array.php');
    }
}
