# Contributing

First of all, many thanks to spend your time on this library!

## Workflow

1. Fork [susina/xml-to-array](https://github.com/susina/xml-to-array) repository, clone it locally and apply your patches.
2. Run the test suite by `composer test` command and fix all red tests.
3. Run static analysis tool by `composer analytics` command and fix all errors.
4. Fix the coding standard by running `composer cs:fix`.

> We provide a __check__ command for all the previously described actions: run `composer check` before submitting a pull request.

## Running the Test Suite

While developing, the test part is very important: if you apply a patch to the existing code, the test suite must run without errors or failures and if you add a new functionality, no one will consider it without tests.

Our test tool is [Pest](https://pestphp.com/) and we provide a script to launch it:

```bash
composer test
```

## Code Coverage

We provide three commands to print the code coverage report or to generate it in _html_ or _xml_ format:

-  `composer coverage` to print a coverage summary on your console
-  `composer coverage:html` command generates a code coverage report in _html_ format, into the directory `coverage/`
-  `composer coverage:clover` generates the report in _xml_ format, into `clover.xml` file.


## Static Analysis Tool

To prevent as many bugs as possible, we use a static analysis tool called [Psalm](https://psalm.dev/).
To launch it, run the following command:

```bash
composer analytics
```

After its analysis, Psalm outputs errors and issues with its suggestions on how to fix them.


## Coding Standard

We ship our script to easily fix coding standard errors, via [php-cs-fixer](https://cs.symfony.com/) tool.
To fix coding standard errors just run:

```bash
composer cs:fix
```

and to show the errors without fixing them, run:

```bash
composer cs:check
```

If you want to learn more about our code style, see [https://github.com/susina/coding-standard](https://github.com/susina/coding-standard).
