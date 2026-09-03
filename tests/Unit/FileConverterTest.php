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
use Susina\XmlToArray\Tests\VfsTestCase;
use Susina\XmlToArray\FileConverter;
use Susina\XmlToArray\Tests\XmlToArrayDataProvider;

class FileConverterTest extends VfsTestCase
{
    #[DataProviderExternal(XmlToArrayDataProvider::class, 'xmlProvider')]
    public function testConvertXmlFileToArray(string $xml, array $expected): void
    {
        $file = $this->createFile('test_file.xml', $xml);
        $actual = FileConverter::create()->convert($file->url());

        $this->assertSame($expected, $actual);
    }

    public function testConvertNotExistentXmlFileThrowsException(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageIs('The file `vfs://root/notexistent.xml` does not exist.');
        FileConverter::create()->convert('vfs://root/notexistent.xml');
    }

    public function testConvertNotReadableXmlFileThrowsException(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageIs('The file `vfs://root/notreadable.xml` is not readable: do you have the correct permissions?');

        $file = $this->createFile('notreadable.xml', '<root></root>');
        $file->chmod(000);

        FileConverter::create()->convert($file->url());
    }

    #[DataProviderExternal(XmlToArrayDataProvider::class, 'convertAndSaveProvider')]
    public function testConvertXmlFileAndSaveIntoAnotherFile(string $xml, array $expectedArray, string $expectedContent): void
    {
        $xmlFile = $this->createFile('xml_file.xml', $xml);
        $saveFile = $this->createFile('saved_file.php');

        $converter = new FileConverter();
        $converter->convertAndSave($xmlFile->url(), $saveFile->url());
        $actual = include($saveFile->url());

        $this->assertSame($expectedArray, $actual);
        $this->assertSame($expectedContent, $saveFile->getContent());
        $this->assertSame($expectedContent, file_get_contents($saveFile->url()));
    }

    #[DataProviderExternal(XmlToArrayDataProvider::class, 'convertAndSaveProvider')]
    public function testConvertAndSaveCreatesOutputFileIfNotExistent(string $xml, array $expectedArray, string $expectedContent): void
    {
        $xmlFile = $this->createFile('xml_file.xml', $xml);

        $converter = new FileConverter();
        $converter->convertAndSave($xmlFile->url(), $this->root->url() . '/my_saved_file.php');

        $this->assertFileExists('vfs://root/my_saved_file.php');

        $actual = include($this->root->url() . '/my_saved_file.php');

        $this->assertSame($expectedArray, $actual);
        $this->assertSame($expectedContent, file_get_contents($this->root->url() . '/my_saved_file.php'));
    }

    public function testSaveInNotExistentDirectoryThrowsException(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageIs("The directory `vfs://root/my_dir` does not exist: you should create it before writing a file.");

        $xmlFile = $this->createFile('xml_file.xml', "<movies><movie><title>The Lord Of The Rings</title><starred>false</starred></movie></movies>");
        $converter = new FileConverter();
        $converter->convertAndSave($xmlFile->url(), $this->root->url() . '/my_dir/my_array.php');
    }

    public function testSaveInNotWriteableDirectoryThrowsException(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageIs("It's impossible to write into `vfs://root/xml_dir` directory: do you have the correct permissions?");

        $dir = vfsStream::newDirectory('xml_dir', 000)->at($this->root);
        $xmlFile = $this->createFile('xml_file.xml', "<movies><movie><title>The Lord Of The Rings</title><starred>false</starred></movie></movies>");
        $converter = new FileConverter();
        $converter->convertAndSave($xmlFile->url(), $dir->url() . '/my_array.php');
    }
}
