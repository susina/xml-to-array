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

namespace Susina\XmlToArray;

class FileConverter
{
    private Converter $converter;

    /**
     * Static constructor.
     */
    public static function create(array $options = []): self
    {
        return new self($options);
    }

    /**
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
     * @return array
     *
     * @throws \RuntimeException If the file does not exist or it's not readable.
     *
     */
    public function convert(string $xmlFile): array
    {
        $this->assertValidFile($xmlFile);

        return $this->converter->convert(file_get_contents($xmlFile));
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
        $this->assertValidFile($xmlFile);

        $this->converter->convertAndSave(file_get_contents($xmlFile), $saveFile);
    }

    /**
     * Check if a file exists and is readable
     *
     * @throws \RuntimeException If the file is not writeable or the directory doesn't exist.
     */
    private function assertValidFile(string $filename): void
    {
        if (!file_exists($filename)) {
            throw new \RuntimeException("The file `$filename` does not exist.");
        }

        if (!is_readable($filename)) {
            throw new \RuntimeException("The file `$filename` is not readable: do you have the correct permissions?");
        }
    }
}
