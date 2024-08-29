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

namespace Susina\XmlToArray\Exception;

class ConverterException extends \RuntimeException
{
    /**
     * Create an exception based on LibXMLError objects
     *
     * @param \LibXMLError[] $errors Array of LibXMLError objects
     *
     * @see http://www.php.net/manual/en/class.libxmlerror.php
     */
    public function __construct(array $errors)
    {
        $message = (count($errors) === 1 ? 'An error ' : 'Some errors ') .
            "occurred while parsing XML string:\n"
        ;

        foreach ($errors as $error) {
            $message .= ' - ' .
                match ($error->level) {
                    LIBXML_ERR_WARNING => "Warning ",
                    LIBXML_ERR_ERROR => "Error ",
                    LIBXML_ERR_FATAL => "Fatal "
                }
            .
                "$error->code: $error->message"
            ;
        }

        parent::__construct($message);
    }
}
