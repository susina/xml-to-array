<?php declare(strict_types=1);

return  [
  'name' => 'bookstore',
  'defaultIdMethod' => 'native',
  'namespace' => 'Propel\\Tests\\Bookstore',
  'table' =>
   [
    0 =>
     [
      'name' => 'book',
      'description' => 'Book Table',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'required' => true,
          'primaryKey' => true,
          'autoIncrement' => true,
          'type' => 'INTEGER',
          'description' => 'Book Id',
        ],
        1 =>
         [
          'name' => 'title',
          'type' => 'VARCHAR',
          'required' => true,
          'description' => 'Book Title',
          'primaryString' => true,
        ],
        2 =>
         [
          'name' => 'isbn',
          'required' => true,
          'type' => 'VARCHAR',
          'size' => 24,
          'phpName' => 'ISBN',
          'description' => 'ISBN Number',
          'primaryString' => false,
        ],
        3 =>
         [
          'name' => 'price',
          'required' => false,
          'type' => 'FLOAT',
          'description' => 'Price of the book.',
        ],
        4 =>
         [
          'name' => 'publisher_id',
          'required' => false,
          'type' => 'INTEGER',
          'description' => 'Foreign Key Publisher',
        ],
        5 =>
         [
          'name' => 'author_id',
          'required' => false,
          'type' => 'INTEGER',
          'description' => 'Foreign Key Author',
        ],
      ],
      'foreign-key' =>
       [
        0 =>
         [
          'foreignTable' => 'publisher',
          'onDelete' => 'setnull',
          'reference' =>
           [
            'local' => 'publisher_id',
            'foreign' => 'id',
          ],
        ],
        1 =>
         [
          'foreignTable' => 'author',
          'onDelete' => 'setnull',
          'onUpdate' => 'cascade',
          'reference' =>
           [
            'local' => 'author_id',
            'foreign' => 'id',
          ],
        ],
      ],
    ],
    1 =>
     [
      'name' => 'publisher',
      'description' => 'Publisher Table',
      'defaultStringFormat' => 'XML',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'required' => true,
          'primaryKey' => true,
          'autoIncrement' => true,
          'type' => 'INTEGER',
          'description' => 'Publisher Id',
        ],
        1 =>
         [
          'name' => 'name',
          'required' => true,
          'type' => 'VARCHAR',
          'size' => 128,
          'default' => 'Penguin',
          'description' => 'Publisher Name',
        ],
      ],
    ],
    2 =>
     [
      'name' => 'author',
      'description' => 'Author Table',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'required' => true,
          'primaryKey' => true,
          'autoIncrement' => true,
          'type' => 'INTEGER',
          'description' => 'Author Id',
        ],
        1 =>
         [
          'name' => 'first_name',
          'required' => true,
          'type' => 'VARCHAR',
          'size' => 128,
          'description' => 'First Name',
        ],
        2 =>
         [
          'name' => 'last_name',
          'required' => true,
          'type' => 'VARCHAR',
          'size' => 128,
          'description' => 'Last Name',
        ],
        3 =>
         [
          'name' => 'email',
          'type' => 'VARCHAR',
          'size' => 128,
          'description' => 'E-Mail Address',
        ],
        4 =>
         [
          'name' => 'age',
          'type' => 'INTEGER',
          'description' => 'The authors age',
        ],
      ],
    ],
    3 =>
     [
      'name' => 'book_summary',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'required' => true,
          'primaryKey' => true,
          'autoIncrement' => true,
          'type' => 'INTEGER',
        ],
        1 =>
         [
          'name' => 'book_id',
          'required' => true,
          'type' => 'INTEGER',
        ],
        2 =>
         [
          'name' => 'summary',
          'required' => true,
          'type' => 'LONGVARCHAR',
        ],
      ],
      'foreign-key' =>
       [
        'phpName' => 'SummarizedBook',
        'foreignTable' => 'book',
        'onDelete' => 'cascade',
        'reference' =>
         [
          'local' => 'book_id',
          'foreign' => 'id',
        ],
      ],
    ],
    4 =>
     [
      'name' => 'review',
      'description' => 'Book Review',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'required' => true,
          'primaryKey' => true,
          'autoIncrement' => true,
          'type' => 'INTEGER',
          'description' => 'Review Id',
        ],
        1 =>
         [
          'name' => 'reviewed_by',
          'required' => true,
          'type' => 'VARCHAR',
          'size' => 128,
          'description' => 'Reviewer Name',
        ],
        2 =>
         [
          'name' => 'review_date',
          'required' => true,
          'type' => 'DATE',
          'default' => '2001-01-01',
          'description' => 'Date of Review',
        ],
        3 =>
         [
          'name' => 'recommended',
          'required' => true,
          'type' => 'BOOLEAN',
          'description' => 'Does reviewer recommend book?',
        ],
        4 =>
         [
          'name' => 'status',
          'type' => 'VARCHAR',
          'size' => 8,
          'description' => 'The status of this review.',
        ],
        5 =>
         [
          'name' => 'book_id',
          'required' => false,
          'type' => 'INTEGER',
          'description' => 'Book ID for this review',
        ],
      ],
      'foreign-key' =>
       [
        'foreignTable' => 'book',
        'onDelete' => 'cascade',
        'reference' =>
         [
          'local' => 'book_id',
          'foreign' => 'id',
        ],
      ],
    ],
    5 =>
     [
      'name' => 'essay',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'required' => true,
          'primaryKey' => true,
          'autoIncrement' => true,
          'type' => 'INTEGER',
        ],
        1 =>
         [
          'name' => 'title',
          'type' => 'VARCHAR',
          'required' => true,
          'primaryString' => true,
        ],
        2 =>
         [
          'name' => 'first_author_id',
          'required' => false,
          'type' => 'INTEGER',
          'description' => 'Foreign Key Author',
        ],
        3 =>
         [
          'name' => 'second_author_id',
          'required' => false,
          'type' => 'INTEGER',
          'description' => 'Foreign Key Author',
        ],
        4 =>
         [
          'name' => 'subtitle',
          'type' => 'VARCHAR',
          'phpName' => 'SecondTitle',
        ],
        5 =>
         [
          'name' => 'next_essay_id',
          'required' => false,
          'type' => 'INTEGER',
          'description' => 'Book Id',
        ],
      ],
      'foreign-key' =>
       [
        0 =>
         [
          'foreignTable' => 'author',
          'onDelete' => 'setnull',
          'onUpdate' => 'cascade',
          'phpName' => 'FirstAuthor',
          'reference' =>
           [
            'local' => 'first_author_id',
            'foreign' => 'id',
          ],
        ],
        1 =>
         [
          'foreignTable' => 'author',
          'defaultJoin' => 'INNER JOIN',
          'onDelete' => 'setnull',
          'onUpdate' => 'cascade',
          'phpName' => 'SecondAuthor',
          'reference' =>
           [
            'local' => 'second_author_id',
            'foreign' => 'id',
          ],
        ],
        2 =>
         [
          'foreignTable' => 'essay',
          'onDelete' => 'setnull',
          'onUpdate' => 'cascade',
          'reference' =>
           [
            'local' => 'next_essay_id',
            'foreign' => 'id',
          ],
        ],
      ],
    ],
    6 =>
     [
      'name' => 'composite_essay',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'required' => true,
          'primaryKey' => true,
          'autoIncrement' => true,
          'type' => 'INTEGER',
        ],
        1 =>
         [
          'name' => 'title',
          'type' => 'VARCHAR',
          'required' => true,
          'primaryString' => true,
        ],
        2 =>
         [
          'name' => 'first_essay_id',
          'required' => false,
          'type' => 'INTEGER',
          'description' => 'Book Id',
        ],
        3 =>
         [
          'name' => 'second_essay_id',
          'required' => false,
          'type' => 'INTEGER',
          'description' => 'Book Id',
        ],
      ],
      'foreign-key' =>
       [
        0 =>
         [
          'foreignTable' => 'composite_essay',
          'onDelete' => 'setnull',
          'onUpdate' => 'cascade',
          'phpName' => 'firstEssay',
          'reference' =>
           [
            'local' => 'first_essay_id',
            'foreign' => 'id',
          ],
        ],
        1 =>
         [
          'foreignTable' => 'composite_essay',
          'onDelete' => 'setnull',
          'onUpdate' => 'cascade',
          'phpName' => 'secondEssay',
          'reference' =>
           [
            'local' => 'second_essay_id',
            'foreign' => 'id',
          ],
        ],
      ],
    ],
    7 =>
     [
      'name' => 'man',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
        ],
        1 =>
         [
          'name' => 'wife_id',
          'type' => 'INTEGER',
        ],
      ],
      'foreign-key' =>
       [
        'foreignTable' => 'woman',
        'onDelete' => 'setnull',
        'reference' =>
         [
          'local' => 'wife_id',
          'foreign' => 'id',
        ],
      ],
    ],
    8 =>
     [
      'name' => 'woman',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
          'required' => true,
        ],
        1 =>
         [
          'name' => 'husband_id',
          'type' => 'INTEGER',
        ],
      ],
      'foreign-key' =>
       [
        'foreignTable' => 'man',
        'reference' =>
         [
          'local' => 'husband_id',
          'foreign' => 'id',
        ],
      ],
    ],
    9 =>
     [
      'name' => 'media',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'required' => true,
          'primaryKey' => true,
          'autoIncrement' => true,
          'type' => 'INTEGER',
          'description' => 'Media Id',
        ],
        1 =>
         [
          'name' => 'cover_image',
          'type' => 'BLOB',
          'lazyLoad' => true,
          'description' => 'The image of the book cover.',
        ],
        2 =>
         [
          'name' => 'excerpt',
          'type' => 'CLOB',
          'lazyLoad' => true,
          'description' => 'An excerpt from the book.',
        ],
        3 =>
         [
          'name' => 'book_id',
          'required' => true,
          'type' => 'INTEGER',
          'description' => 'Book ID for this media collection.',
        ],
      ],
      'foreign-key' =>
       [
        'foreignTable' => 'book',
        'onDelete' => 'cascade',
        'reference' =>
         [
          'local' => 'book_id',
          'foreign' => 'id',
        ],
      ],
    ],
    10 =>
     [
      'name' => 'book_club_list',
      'description' => 'Reading list for a book club.',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'required' => true,
          'primaryKey' => true,
          'autoIncrement' => true,
          'type' => 'INTEGER',
          'description' => 'Unique ID for a school reading list.',
        ],
        1 =>
         [
          'name' => 'group_leader',
          'required' => true,
          'type' => 'VARCHAR',
          'size' => 100,
          'description' => 'The name of the teacher in charge of summer reading.',
        ],
        2 =>
         [
          'name' => 'theme',
          'required' => false,
          'type' => 'VARCHAR',
          'size' => 50,
          'description' => 'The theme, if applicable, for the reading list.',
        ],
        3 =>
         [
          'name' => 'created_at',
          'required' => false,
          'type' => 'TIMESTAMP',
        ],
      ],
    ],
    11 =>
     [
      'name' => 'book_x_list',
      'phpName' => 'BookListRel',
      'isCrossRef' => true,
      'description' => 'Cross-reference table between book and book_club_list rows.',
      'column' =>
       [
        0 =>
         [
          'name' => 'book_id',
          'primaryKey' => true,
          'type' => 'INTEGER',
          'description' => 'Fkey to book.id',
        ],
        1 =>
         [
          'name' => 'book_club_list_id',
          'primaryKey' => true,
          'type' => 'INTEGER',
          'description' => 'Fkey to book_club_list.id',
        ],
      ],
      'foreign-key' =>
       [
        0 =>
         [
          'foreignTable' => 'book',
          'onDelete' => 'cascade',
          'reference' =>
           [
            'local' => 'book_id',
            'foreign' => 'id',
          ],
        ],
        1 =>
         [
          'foreignTable' => 'book_club_list',
          'onDelete' => 'cascade',
          'reference' =>
           [
            'local' => 'book_club_list_id',
            'foreign' => 'id',
          ],
        ],
      ],
    ],
    12 =>
     [
      'name' => 'book_club_list_favorite_books',
      'phpName' => 'BookListFavorite',
      'isCrossRef' => true,
      'description' => 'Another cross-reference table for many-to-many relationship between book rows and book_club_list rows for favorite books.',
      'column' =>
       [
        0 =>
         [
          'name' => 'book_id',
          'primaryKey' => true,
          'type' => 'INTEGER',
          'description' => 'Fkey to book.id',
        ],
        1 =>
         [
          'name' => 'book_club_list_id',
          'primaryKey' => true,
          'type' => 'INTEGER',
          'description' => 'Fkey to book_club_list.id',
        ],
      ],
      'foreign-key' =>
       [
        0 =>
         [
          'foreignTable' => 'book',
          'phpName' => 'FavoriteBook',
          'onDelete' => 'cascade',
          'reference' =>
           [
            'local' => 'book_id',
            'foreign' => 'id',
          ],
        ],
        1 =>
         [
          'foreignTable' => 'book_club_list',
          'phpName' => 'FavoriteBookClubList',
          'onDelete' => 'cascade',
          'reference' =>
           [
            'local' => 'book_club_list_id',
            'foreign' => 'id',
          ],
        ],
      ],
    ],
    13 =>
     [
      'name' => 'bookstore_employee',
      'description' => 'Hierarchical table to represent employees of a bookstore.',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
          'description' => 'Employee ID number',
        ],
        1 =>
         [
          'name' => 'class_key',
          'type' => 'INTEGER',
          'required' => true,
          'default' => 0,
          'inheritance' =>
           [
            0 =>
             [
              'key' => 0,
              'class' => 'BookstoreEmployee',
            ],
            1 =>
             [
              'key' => 1,
              'class' => 'BookstoreManager',
              'extends' => 'BookstoreEmployee',
            ],
            2 =>
             [
              'key' => 2,
              'class' => 'BookstoreCashier',
              'extends' => 'BookstoreEmployee',
            ],
            3 =>
             [
              'key' => 3,
              'class' => 'BookstoreHead',
              'extends' => 'BookstoreManager',
            ],
          ],
        ],
        2 =>
         [
          'name' => 'name',
          'type' => 'VARCHAR',
          'size' => 32,
          'description' => 'Employee name',
        ],
        3 =>
         [
          'name' => 'job_title',
          'type' => 'VARCHAR',
          'size' => 32,
          'description' => 'Employee job title',
        ],
        4 =>
         [
          'name' => 'supervisor_id',
          'type' => 'INTEGER',
          'description' => 'Fkey to supervisor.',
        ],
        5 =>
         [
          'name' => 'photo',
          'type' => 'BLOB',
          'lazyLoad' => true,
        ],
      ],
      'foreign-key' =>
       [
        'foreignTable' => 'bookstore_employee',
        'phpName' => 'Supervisor',
        'refPhpName' => 'Subordinate',
        'onDelete' => 'setnull',
        'reference' =>
         [
          'local' => 'supervisor_id',
          'foreign' => 'id',
        ],
      ],
    ],
    14 =>
     [
      'name' => 'bookstore_employee_account',
      'reloadOnInsert' => true,
      'reloadOnUpdate' => true,
      'description' => 'Bookstore employees login credentials.',
      'column' =>
       [
        0 =>
         [
          'name' => 'employee_id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'description' => 'Primary key for the account ...',
        ],
        1 =>
         [
          'name' => 'login',
          'type' => 'VARCHAR',
          'size' => 32,
        ],
        2 =>
         [
          'name' => 'password',
          'type' => 'VARCHAR',
          'size' => 100,
          'default' => '\'@\'\'34"',
        ],
        3 =>
         [
          'name' => 'enabled',
          'type' => 'BOOLEAN',
          'default' => true,
        ],
        4 =>
         [
          'name' => 'not_enabled',
          'type' => 'BOOLEAN',
          'default' => false,
        ],
        5 =>
         [
          'name' => 'created',
          'type' => 'TIMESTAMP',
          'defaultExpr' => 'CURRENT_TIMESTAMP',
        ],
        6 =>
         [
          'name' => 'updated',
          'type' => 'TIMESTAMP',
          'defaultExpr' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ],
        7 =>
         [
          'name' => 'role_id',
          'type' => 'INTEGER',
          'required' => false,
          'default' => 'null',
        ],
        8 =>
         [
          'name' => 'authenticator',
          'type' => 'VARCHAR',
          'size' => 32,
          'defaultExpr' => '\'Password\'',
        ],
      ],
      'foreign-key' =>
       [
        0 =>
         [
          'foreignTable' => 'bookstore_employee',
          'onDelete' => 'cascade',
          'reference' =>
           [
            'local' => 'employee_id',
            'foreign' => 'id',
          ],
        ],
        1 =>
         [
          'foreignTable' => 'acct_access_role',
          'onDelete' => 'setnull',
          'reference' =>
           [
            'local' => 'role_id',
            'foreign' => 'id',
          ],
        ],
      ],
      'unique' =>
       [
        'unique-column' =>
         [
          'name' => 'login',
        ],
      ],
    ],
    15 =>
     [
      'name' => 'acct_audit_log',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
        ],
        1 =>
         [
          'name' => 'uid',
          'type' => 'VARCHAR',
          'size' => 32,
          'required' => true,
        ],
        2 =>
         [
          'name' => 'message',
          'type' => 'VARCHAR',
          'size' => 255,
        ],
      ],
      'foreign-key' =>
       [
        'foreignTable' => 'bookstore_employee_account',
        'onDelete' => 'cascade',
        'reference' =>
         [
          'local' => 'uid',
          'foreign' => 'login',
        ],
      ],
      'index' =>
       [
        'index-column' =>
         [
          0 =>
           [
            'name' => 'id',
          ],
          1 =>
           [
            'name' => 'uid',
          ],
        ],
      ],
      'unique' =>
       [
        'unique-column' =>
         [
          0 =>
           [
            'name' => 'uid',
          ],
          1 =>
           [
            'name' => 'message',
          ],
        ],
      ],
    ],
    16 =>
     [
      'name' => 'acct_access_role',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
          'description' => 'Role ID number',
        ],
        1 =>
         [
          'name' => 'name',
          'type' => 'VARCHAR',
          'size' => 25,
          'required' => true,
        ],
      ],
    ],
    17 =>
     [
      'name' => 'book_reader',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
          'description' => 'Book reader ID number',
        ],
        1 =>
         [
          'name' => 'name',
          'type' => 'VARCHAR',
          'size' => 50,
        ],
      ],
    ],
    18 =>
     [
      'name' => 'book_opinion',
      'column' =>
       [
        0 =>
         [
          'name' => 'book_id',
          'type' => 'INTEGER',
          'primaryKey' => true,
        ],
        1 =>
         [
          'name' => 'reader_id',
          'type' => 'INTEGER',
          'primaryKey' => true,
        ],
        2 =>
         [
          'name' => 'rating',
          'type' => 'DECIMAL',
        ],
        3 =>
         [
          'name' => 'recommend_to_friend',
          'type' => 'BOOLEAN',
        ],
      ],
      'foreign-key' =>
       [
        0 =>
         [
          'foreignTable' => 'book',
          'onDelete' => 'cascade',
          'reference' =>
           [
            'local' => 'book_id',
            'foreign' => 'id',
          ],
        ],
        1 =>
         [
          'foreignTable' => 'book_reader',
          'onDelete' => 'cascade',
          'reference' =>
           [
            'local' => 'reader_id',
            'foreign' => 'id',
          ],
        ],
      ],
    ],
    19 =>
     [
      'name' => 'reader_favorite',
      'column' =>
       [
        0 =>
         [
          'name' => 'book_id',
          'type' => 'INTEGER',
          'primaryKey' => true,
        ],
        1 =>
         [
          'name' => 'reader_id',
          'type' => 'INTEGER',
          'primaryKey' => true,
        ],
      ],
      'foreign-key' =>
       [
        0 =>
         [
          'foreignTable' => 'book',
          'onDelete' => 'cascade',
          'reference' =>
           [
            'local' => 'book_id',
            'foreign' => 'id',
          ],
        ],
        1 =>
         [
          'foreignTable' => 'book_reader',
          'onDelete' => 'cascade',
          'reference' =>
           [
            'local' => 'reader_id',
            'foreign' => 'id',
          ],
        ],
        2 =>
         [
          'foreignTable' => 'book_opinion',
          'onDelete' => 'cascade',
          'reference' =>
           [
            0 =>
             [
              'local' => 'book_id',
              'foreign' => 'book_id',
            ],
            1 =>
             [
              'local' => 'reader_id',
              'foreign' => 'reader_id',
            ],
          ],
        ],
      ],
    ],
    20 =>
     [
      'name' => 'bookstore',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
          'description' => 'Book store ID number',
        ],
        1 =>
         [
          'name' => 'store_name',
          'type' => 'VARCHAR',
          'size' => 50,
          'required' => true,
        ],
        2 =>
         [
          'name' => 'location',
          'type' => 'VARCHAR',
          'size' => 100,
        ],
        3 =>
         [
          'name' => 'population_served',
          'type' => 'BIGINT',
        ],
        4 =>
         [
          'name' => 'total_books',
          'type' => 'INTEGER',
        ],
        5 =>
         [
          'name' => 'store_open_time',
          'type' => 'TIME',
        ],
        6 =>
         [
          'name' => 'website',
          'type' => 'VARCHAR',
          'size' => 255,
        ],
      ],
    ],
    21 =>
     [
      'name' => 'bookstore_sale',
      'reloadOnUpdate' => true,
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
        ],
        1 =>
         [
          'name' => 'bookstore_id',
          'type' => 'INTEGER',
          'required' => false,
          'default' => 1,
        ],
        2 =>
         [
          'name' => 'publisher_id',
          'type' => 'INTEGER',
          'required' => false,
        ],
        3 =>
         [
          'name' => 'sale_name',
          'type' => 'VARCHAR',
          'size' => 100,
          'required' => false,
        ],
        4 =>
         [
          'name' => 'discount',
          'type' => 'TINYINT',
          'description' => 'Discount percentage',
          'defaultExpr' => 10,
        ],
      ],
      'foreign-key' =>
       [
        0 =>
         [
          'foreignTable' => 'bookstore',
          'onDelete' => 'cascade',
          'reference' =>
           [
            'local' => 'bookstore_id',
            'foreign' => 'id',
          ],
        ],
        1 =>
         [
          'foreignTable' => 'publisher',
          'onDelete' => 'setnull',
          'reference' =>
           [
            'local' => 'publisher_id',
            'foreign' => 'id',
          ],
        ],
      ],
    ],
    22 =>
     [
      'name' => 'customer',
      'allowPkInsert' => true,
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
        ],
        1 =>
         [
          'name' => 'name',
          'type' => 'VARCHAR',
          'size' => 255,
        ],
        2 =>
         [
          'name' => 'join_date',
          'type' => 'DATE',
        ],
      ],
    ],
    23 =>
     [
      'name' => 'contest',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
        ],
        1 =>
         [
          'name' => 'name',
          'type' => 'VARCHAR',
          'size' => 100,
        ],
        2 =>
         [
          'name' => 'country_code',
          'type' => 'VARCHAR',
          'size' => 6,
        ],
      ],
      'foreign-key' =>
       [
        'foreignTable' => 'country',
        'onDelete' => 'setnull',
        'reference' =>
         [
          'local' => 'country_code',
          'foreign' => 'code',
        ],
      ],
    ],
    24 =>
     [
      'name' => 'country_translation',
      'readOnly' => true,
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
        ],
        1 =>
         [
          'name' => 'country_code',
          'type' => 'VARCHAR',
          'size' => 6,
        ],
        2 =>
         [
          'name' => 'language_code',
          'type' => 'VARCHAR',
          'size' => 6,
        ],
        3 =>
         [
          'name' => 'label',
          'type' => 'VARCHAR',
          'size' => 100,
        ],
      ],
      'index' =>
       [
        'index-column' =>
         [
          'name' => 'country_code',
        ],
      ],
      'foreign-key' =>
       [
        'foreignTable' => 'country',
        'onDelete' => 'cascade',
        'reference' =>
         [
          'local' => 'country_code',
          'foreign' => 'code',
        ],
      ],
    ],
    25 =>
     [
      'name' => 'country',
      'readOnly' => true,
      'column' =>
       [
        0 =>
         [
          'name' => 'code',
          'type' => 'VARCHAR',
          'size' => 6,
          'primaryKey' => true,
        ],
        1 =>
         [
          'name' => 'capital',
          'type' => 'VARCHAR',
          'size' => 100,
        ],
      ],
    ],
    26 =>
     [
      'name' => 'bookstore_contest',
      'column' =>
       [
        0 =>
         [
          'name' => 'bookstore_id',
          'type' => 'INTEGER',
          'primaryKey' => true,
        ],
        1 =>
         [
          'name' => 'contest_id',
          'type' => 'INTEGER',
          'primaryKey' => true,
        ],
        2 =>
         [
          'name' => 'prize_book_id',
          'type' => 'INTEGER',
        ],
      ],
      'foreign-key' =>
       [
        0 =>
         [
          'foreignTable' => 'bookstore',
          'onDelete' => 'cascade',
          'reference' =>
           [
            'local' => 'bookstore_id',
            'foreign' => 'id',
          ],
        ],
        1 =>
         [
          'foreignTable' => 'contest',
          'onDelete' => 'cascade',
          'reference' =>
           [
            'local' => 'contest_id',
            'foreign' => 'id',
          ],
        ],
        2 =>
         [
          'foreignTable' => 'book',
          'onDelete' => 'setnull',
          'phpName' => 'Work',
          'reference' =>
           [
            'local' => 'prize_book_id',
            'foreign' => 'id',
          ],
        ],
      ],
    ],
    27 =>
     [
      'name' => 'bookstore_contest_entry',
      'reloadOnInsert' => true,
      'column' =>
       [
        0 =>
         [
          'name' => 'bookstore_id',
          'type' => 'INTEGER',
          'primaryKey' => true,
        ],
        1 =>
         [
          'name' => 'contest_id',
          'type' => 'INTEGER',
          'primaryKey' => true,
        ],
        2 =>
         [
          'name' => 'customer_id',
          'type' => 'INTEGER',
          'primaryKey' => true,
        ],
        3 =>
         [
          'name' => 'entry_date',
          'type' => 'TIMESTAMP',
          'defaultExpr' => 'CURRENT_TIMESTAMP',
        ],
      ],
      'foreign-key' =>
       [
        0 =>
         [
          'foreignTable' => 'bookstore',
          'onDelete' => 'cascade',
          'reference' =>
           [
            'local' => 'bookstore_id',
            'foreign' => 'id',
          ],
        ],
        1 =>
         [
          'foreignTable' => 'customer',
          'onDelete' => 'cascade',
          'reference' =>
           [
            'local' => 'customer_id',
            'foreign' => 'id',
          ],
        ],
        2 =>
         [
          'foreignTable' => 'bookstore_contest',
          'onDelete' => 'cascade',
          'reference' =>
           [
            0 =>
             [
              'local' => 'bookstore_id',
              'foreign' => 'bookstore_id',
            ],
            1 =>
             [
              'local' => 'contest_id',
              'foreign' => 'contest_id',
            ],
          ],
        ],
      ],
    ],
    28 =>
     [
      'name' => 'book2',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
        ],
        1 =>
         [
          'name' => 'title',
          'type' => 'VARCHAR',
        ],
        2 =>
         [
          'name' => 'style',
          'type' => 'ENUM',
          'valueSet' => 'novel, essay, poetry',
        ],
        3 =>
         [
          'name' => 'style2',
          'type' => 'SET',
          'valueSet' => 'novel, essay, poetry',
        ],
        4 =>
         [
          'name' => 'tags',
          'type' => 'ARRAY',
        ],
        5 =>
         [
          'name' => 'uuid',
          'required' => false,
          'type' => 'UUID',
        ],
        6 =>
         [
          'name' => 'uuid_bin',
          'required' => false,
          'type' => 'UUID_BINARY',
        ],
      ],
      'index' =>
       [
        'index-column' =>
         [
          'name' => 'uuid_bin',
        ],
      ],
    ],
    29 =>
     [
      'name' => 'distribution',
      'abstract' => true,
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
        ],
        1 =>
         [
          'name' => 'name',
          'type' => 'VARCHAR',
        ],
        2 =>
         [
          'name' => 'type',
          'type' => 'INTEGER',
          'required' => true,
          'default' => 0,
          'inheritance' =>
           [
            0 =>
             [
              'key' => 44,
              'class' => 'DistributionStore',
            ],
            1 =>
             [
              'key' => 23,
              'class' => 'DistributionOnline',
              'extends' => 'DistributionStore',
            ],
            2 =>
             [
              'key' => 3838,
              'class' => 'DistributionVirtualStore',
              'extends' => 'DistributionStore',
            ],
          ],
        ],
        3 =>
         [
          'name' => 'distribution_manager_id',
          'type' => 'INTEGER',
          'required' => true,
        ],
      ],
      'foreign-key' =>
       [
        'foreignTable' => 'distribution_manager',
        'onDelete' => 'cascade',
        'reference' =>
         [
          'local' => 'distribution_manager_id',
          'foreign' => 'id',
        ],
      ],
    ],
    30 =>
     [
      'name' => 'distribution_manager',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
        ],
        1 =>
         [
          'name' => 'name',
          'type' => 'VARCHAR',
        ],
      ],
    ],
    31 =>
     [
      'name' => 'record_label',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
        ],
        1 =>
         [
          'name' => 'abbr',
          'type' => 'VARCHAR',
          'size' => 5,
          'primaryKey' => true,
          'required' => true,
        ],
        2 =>
         [
          'name' => 'name',
          'type' => 'VARCHAR',
        ],
      ],
    ],
    32 =>
     [
      'name' => 'release_pool',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'type' => 'INTEGER',
          'primaryKey' => true,
          'autoIncrement' => true,
        ],
        1 =>
         [
          'name' => 'record_label_id',
          'type' => 'INTEGER',
          'required' => true,
        ],
        2 =>
         [
          'name' => 'record_label_abbr',
          'type' => 'VARCHAR',
          'size' => 5,
          'required' => true,
        ],
        3 =>
         [
          'name' => 'name',
          'type' => 'VARCHAR',
        ],
      ],
      'foreign-key' =>
       [
        'foreignTable' => 'record_label',
        'onDelete' => 'cascade',
        'reference' =>
         [
          0 =>
           [
            'local' => 'record_label_id',
            'foreign' => 'id',
          ],
          1 =>
           [
            'local' => 'record_label_abbr',
            'foreign' => 'abbr',
          ],
        ],
      ],
    ],
    33 =>
     [
      'name' => 'polymorphic_relation_log',
      'column' =>
       [
        0 =>
         [
          'name' => 'id',
          'primaryKey' => true,
          'autoIncrement' => true,
          'type' => 'INTEGER',
        ],
        1 =>
         [
          'name' => 'message',
          'type' => 'VARCHAR',
          'required' => true,
        ],
        2 =>
         [
          'name' => 'target_id',
          'required' => false,
          'type' => 'INTEGER',
        ],
        3 =>
         [
          'name' => 'target_type',
          'required' => false,
          'type' => 'VARCHAR',
          'size' => 55,
        ],
      ],
      'foreign-key' =>
       [
        0 =>
         [
          'foreignTable' => 'author',
          'onDelete' => 'setnull',
          'onUpdate' => 'cascade',
          'reference' =>
           [
            0 =>
             [
              'local' => 'target_type',
              'value' => 'author',
            ],
            1 =>
             [
              'local' => 'target_id',
              'foreign' => 'id',
            ],
          ],
        ],
        1 =>
         [
          'foreignTable' => 'book',
          'onDelete' => 'setnull',
          'onUpdate' => 'cascade',
          'reference' =>
           [
            0 =>
             [
              'local' => 'target_type',
              'value' => 'book',
            ],
            1 =>
             [
              'local' => 'target_id',
              'foreign' => 'id',
            ],
          ],
        ],
      ],
    ],
  ],
];
