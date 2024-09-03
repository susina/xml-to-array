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

dataset('XmlWithAttributes', [
    [
        "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<config>
  <log>
    <logger name=\"defaultLogger\">
      <type>stream</type>
      <path>/var/log/default.log</path>
      <level>300</level>
    </logger>
    <logger name=\"bookstore\">
      <type>stream</type>
      <path>/var/log/bookstore.log</path>
    </logger>
  </log>
</config>", [
        'log' => [
            'logger' => [
                [
                    '@attributes' => [
                        'name' => 'defaultLogger'
                    ],
                    'type' => 'stream',
                    'path' => '/var/log/default.log',
                    'level' => 300,
                ],
                [
                    '@attributes' => [
                        'name' => 'bookstore'
                    ],
                    'type' => 'stream',
                    'path' => '/var/log/bookstore.log',
                ],
            ],
        ]]
    ],
    [
        "<config>
    <database name=\"TestDb\">
        <table name=\"table1\"></table>
        <table name=\"table2\"></table>
    </database>
</config>", [
        'database' => [
            '@attributes' => [
                'name' => 'TestDb'
            ],
            'table' => [
                0 => [
                    '@attributes' => [
                        'name' => 'table1'
                    ]
                ],
                1 => [
                    '@attributes' => [
                        'name' => 'table2'
                    ]
                ]
            ],
        ]
    ]
    ]
]);
