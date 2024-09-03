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

dataset('NoIdConversion', [
    [
        "<?xml version='1.0' standalone='yes'?>
<movies>
    <movie>
        <title>Star Wars</title>
        <starred>True</starred>
        <actor id=\"actorH\" name=\"Harrison Ford\" />
        <actor id=\"actorM\" name=\"Mark Hamill\" />
        <actor id=\"actorC\" name=\"Carrie Fisher\" />
    </movie>
    <movie>
        <title>The Lord Of The Rings</title>
        <starred>false</starred>
    </movie>
</movies>",
        [
            'movie' => [
                0 => [
                    'title' => 'Star Wars',
                    'starred' => true,
                    'actor' => [
                        0 => [
                            'id' => 'actorH',
                            'name' => 'Harrison Ford'
                        ],
                        1 => [
                            'id' => 'actorM',
                            'name' => 'Mark Hamill'
                        ],
                        2 => [
                            'id' => 'actorC',
                            'name' => 'Carrie Fisher'
                        ]
                    ]
                ],
                1 => [
                    'title' => 'The Lord Of The Rings',
                    'starred' => false
                ]
            ]
        ]
    ]
]);
