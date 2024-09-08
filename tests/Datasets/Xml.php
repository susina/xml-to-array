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

dataset('Xml', [
    [
        "<?xml version='1.0' standalone='yes'?>
<movies>
 <movie>
  <title>Star Wars</title>
  <starred>True</starred>
  <percentage>32.5</percentage>
 </movie>
 <movie>
  <title>The Lord Of The Rings</title>
  <starred>false</starred>
 </movie>
</movies>
"
        ,
        ['movie' => [0 => ['title' => 'Star Wars', 'starred' => true, 'percentage' => 32.5], 1 => ['title' => 'The Lord Of The Rings', 'starred' => false]]],
    ],
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
                    'name' => 'defaultLogger',
                    'type' => 'stream',
                    'path' => '/var/log/default.log',
                    'level' => 300,
                ],
                [
                    'name' => 'bookstore',
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
            'name' => 'TestDb',
            'table' => [
                0 => ['name' => 'table1'],
                1 => ['name' => 'table2']
            ],
        ]
    ]
    ],
    [
        '<?xml version="1.0"?><root><!-- This is a comment --><node>foo</node></root>',
        ['node' => 'foo'],
    ],
    [
        '<?xml version="1.0"?><root><node foo="bar"></node></root>',
        ['node' => ['foo' => 'bar']],
    ],
    [
        '<?xml version="1.0"?><root><node>0</node></root>',
        ['node' => 0]
    ],
    [
        '<?xml version="1.0"?><root><node /></root>',
        ['node' => null]
    ],
    [
        '<?xml version="1.0"?><root><node><![CDATA[<salutation>Hello World!</salutation>]]></node></root>',
        ['node' => '<salutation>Hello World!</salutation>']
    ]
]);
