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

use SimpleXMLElement;
use Susina\XmlToArray\Exception\ConverterException;

/**
 * Class to convert an xml string to array
 */
class Converter
{
    /**
     * Static constructor.
     */
    public static function create(): self
    {
        return new self();
    }

    /**
     * Create a PHP array from an XML string.
     *
     * @param string $xmlToParse The XML to parse.
     *
     * @return array
     *
     * @throws ConverterException If errors while parsing XML.
     */
    public function convert(string $xmlToParse): array
    {
        $content = json_encode($this->getSimpleXml($xmlToParse), JSON_NUMERIC_CHECK);
        $array = json_decode($content, true);

        $array = $this->mergeAttributes($array);
        $this->convertBool($array);
        $array = $this->idToKey($array);
    
        return $array;
    }

    /**
     * Parse an XML string and return the relative SimpleXmlElement object.
     */
    private function getSimpleXml(string $xmlToParse): SimpleXMLElement
    {
        $currentInternalErrors = libxml_use_internal_errors(true);

        $xml = simplexml_load_string($xmlToParse);
        if ($xml instanceof SimpleXMLElement) {
            dom_import_simplexml($xml)->ownerDocument->xinclude();
        }

        $errors = libxml_get_errors();

        libxml_clear_errors();
        libxml_use_internal_errors($currentInternalErrors);

        if (count($errors) > 0) {
            throw new ConverterException($errors);
        }

        return $xml;
    }

    /**
     * Merge '@attributes' array into parent.
     */
    private function mergeAttributes(array $array): array
    {
        $out = [];
        foreach ($array as $key => $value) {
            if ($key === '@attributes') {
                $out = array_merge($out, $value);
                continue;
            }
            if (is_array($value)) {
                $out[$key] = $this->mergeAttributes($value);
                continue;
            }

            $out[$key] = $value;
        }

        return $out;
    }

    /**
     * Convert all truely and falsy strings ('True', 'False' etc.)
     * into boolean values.
     * 
     * @param array $array The array to parse.
     */
    private function convertBool(array &$array): void
    {
        array_walk_recursive($array, function (mixed &$value): void {
            $value = match(true) {
                is_string($value) && strtolower($value) === 'true' => true,
                is_string($value) && strtolower($value) === 'false' => false,
                default => $value
            };
        });
    }

    private function idToKey(array $array): array
    {
        $out = [];
        foreach ($array as $key => $value) {
            if(!is_array($value)) {
                $out[$key] = $value;
                continue;
            }
            
            if (!$this->hasIdToMerge($value)) {
                $out[$key] = $this->idToKey($value);
                continue;
            }

            foreach ($value as $k => $v) {
                if (!is_array($v)) {
                    $out[$key][$k] = $v;
                    continue;
                }
                
                $out[$key] = array_merge($out[$key], $this->getIdArray($v));
            }
        }

        return $out;
    }

    private function hasIdToMerge(array $array): bool
    {
        $hasId = false;
        foreach ($array as $value) {
            if (is_array($value) && array_is_list($value)) {
                foreach ($value as $v) {
                    if (is_array($v) && array_key_exists('id', $v)) {
                        $hasId = true;
                    }
                }
            }
        }

        return $hasId;
    }

    private function getIdArray(array $array): array
    {
        $out = [];
        foreach ($array as $value) {
            $out[$value['id']] = array_diff_key($value, ['id' => true]);
        }
        
        return $out;
    }
}
