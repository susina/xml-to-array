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

dataset('Inclusion', [
    [
        "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
    <database name=\"named\" defaultIdMethod=\"native\">
        <xi:include xmlns:xi=\"http://www.w3.org/2001/XInclude\"
                    href=\"vfs://root/testconvert_include.xml\"
                    xpointer=\"xpointer( /database/* )\"
                        />
    </database>",
        "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
    <database name=\"mixin\" defaultIdMethod=\"native\">
        <table name=\"book\" phpName=\"Book\"/>
    </database>",
        [
            'name' => 'named',
            'defaultIdMethod' => 'native',
            'table' => [
                'name' => 'book',
                'phpName' => 'Book',
            ]
        ]
    ]
]);
