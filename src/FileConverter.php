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

class FileConverter extends Converter
{
    /**
     * Create a PHP array from an XML file.
     *
     * @param string $filename The XML file to parse.
     *
     * @return array
     *
     * @throws \RuntimeException If the file does not exist or it's not readable.
     *
     * @psalm-suppress ParamNameMismatch It's a desired behavior, since in this method the parameter
     *                                   is a filename while in the parent methods it's the xml to convert.
     */
    public function convert(string $filename): array
    {
        if (!file_exists($filename)) {
            throw new \RuntimeException("The file `$filename` does not exist.");
        }

        if (!is_readable($filename)) {
            throw new \RuntimeException("The file `$filename` is not readable: do you have the correct permissions?");
        }

        return parent::convert(file_get_contents($filename));
    }
}
