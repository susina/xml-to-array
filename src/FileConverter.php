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

namespace Susina\XmlToArray;

final class FileConverter
{
    private Converter $converter;

    /**
     * Static constructor.
     * 
     * @param mixed[] $options Options to configure the converter.
     * @see Susina\XmlToArray\Converter::__construct()
     */
    public static function create(array $options = []): self
    {
        return new self($options);
    }

    /**
     * @param mixed[] $options Options to configure the converter.
     * @see Susina\XmlToArray\Converter::__construct()
     */
    public function __construct(array $options = [])
    {
        $this->converter = new Converter($options);
    }

    /**
     * Create a PHP array from an XML file.
     *
     * @param string $xmlFile The XML file to parse.
     *
     * @return mixed[] The parsed array.
     *
     * @throws \RuntimeException If the file does not exist or it's not readable.
     *
     */
    public function convert(string $xmlFile): array
    {
        return $this->converter->convert($this->readXmlFile($xmlFile));
    }

    /**
     * Convert an XML file to array and save it to file.
     *
     * @param string $xmlFile The XML file to parse.
     * @param string $saveFile The file where to save the parsed array.
     *
     * @throw \RuntimeException If the file is not writeable or the directory doesn't exist.
     */
    public function convertAndSave(string $xmlFile, string $saveFile): void
    {
        $this->converter->convertAndSave($this->readXmlFile($xmlFile), $saveFile);
    }

    /**
     * Read the content of a given xml file.
     *
     * @throws \RuntimeException If the file is not writeable, the directory doesn't exist or any other problem in reading the file.
     */
    private function readXmlFile(string $filename): string
    {
        if (!file_exists($filename)) {
            throw new \RuntimeException("The file `$filename` does not exist.");
        }

        if (!is_readable($filename)) {
            throw new \RuntimeException("The file `$filename` is not readable: do you have the correct permissions?");
        }

        $content = file_get_contents($filename);
        
        if($content === false) {
            throw new \RuntimeException("Impossible to read `$filename` file.");
        }

        return $content;
    }
}
