<?php declare(strict_types=1);

return  [
  'type' => 'component',
  'version' => 1,
  'method' => 'upgrade',
  'name' => 'com_alpha',
  'author' => 'John Doe',
  'authorEmail' => 'john.doe@example.org',
  'authorUrl' => 'http://www.example.org',
  'copyright' => '(C) 2008 Copyright Info',
  'license' => 'License Info',
  'creationDate' => 'March 2006',
  'description' => 'COM_ALPHA_XML_DESCRIPTION',
  'installfile' => 'file.install.php',
  'uninstallfile' => 'file.uninstall.php',
  'scriptfile' => 'file.script.php',
  'install' =>
   [
    'sql' =>
     [
      'file' => 'sql/install.mysql.utf8.sql',
    ],
  ],
  'uninstall' =>
   [
    'sql' =>
     [
      'file' => 'sql/uninstall.mysql.utf8.sql',
    ],
  ],
  'update' =>
   [
    'schemas' =>
     [
      'schemapath' =>
       [
        0 => 'sql/updates/mysql',
        1 => 'sql/updates/sqlsrv',
      ],
    ],
  ],
  'files' =>
   [
    'folder' => 'site',
    'filename' => 'alpha.php',
  ],
  'media' =>
   [
    'destination' => 'com_alpha',
    'filename' => 'com_alpha.jpg',
  ],
  'administration' =>
   [
    'menu' => 'Alpha',
    'submenu' =>
     [
      'menu' =>
       [
        0 => 'Installer',
        1 => 'Users',
      ],
    ],
    'files' =>
     [
      'folder' => 'sql',
      'filename' =>
       [
        0 => 'admin.alpha.php',
        1 => 'image.png',
        2 => 'applications-internet.png',
        3 => 'applications-internet-16.png',
      ],
    ],
    'languages' =>
     [
      'folder' => 'admin/language',
      'language' =>
       [
        0 => 'en-GB/en-GB.com_alpha.ini',
        1 => 'en-GB/en-GB.com_alpha.sys.ini',
      ],
    ],
  ],
  'updateservers' =>
   [
    'server' =>
     [
      0 => 'http://jsitepoint.com/update/components/com_alpha/extension.xml',
      1 => 'http://jsitepoint.com/update/update.xml',
    ],
  ],
  'tables' =>
   [
    'table' =>
     [
      0 => '#__alpha_install',
      1 => '#__alpha_update',
    ],
  ],
  'dependencies' =>
   [
    'dependency' =>
     [
      'type' => 'platform',
      'name' => 'joomla',
      'operator' => '=',
      'version' => 1.5,
    ],
  ],
];
