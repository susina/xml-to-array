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

namespace Susina\XmlToArray\Tests;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use PHPUnit\Framework\TestCase;

class VfsTestCase extends TestCase
{
    public private(set) vfsStreamDirectory $root {
        get => $this->root ??= vfsStream::setup();
    }

    /**
     * Create a vfsStreamFile based on $path parameter.
     * It creates the directory structure, too.
     *
     * @param string $path
     * @param string $content
     * @return vfsStreamFile
     */
    public function createFile(string $path, string $content = ''): vfsStreamFile
    {
        $dirs = explode('/', $path);
        $fileName = array_pop($dirs);
        $currentDir = $this->root;

        foreach ($dirs as $dir) {
            if (!$currentDir->hasChild($dir)) {
                $currentDir->addChild(vfsStream::newDirectory($dir));
            }
            $currentDir = $currentDir->getChild($dir);
        }

        $file = vfsStream::newFile($fileName)->withContent($content);
        $currentDir->addChild($file);

        return $file;
    }

    public function getIncludedFile(): vfsStreamFile
    {
        return vfsStream::newFile('testconvert_include.xml')
            ->at($this->root)
            ->setContent("<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<database name=\"mixin\" defaultIdMethod=\"native\">
    <table name=\"book\" phpName=\"Book\"/>
</database>")
        ;
    }
}
