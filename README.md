# Calendar

A simple PHP library for calendar operations.  Really just bringing my self back up to speed with
PHP. Uses PHPUnit and PHPDoc for testing and doc generation.  Will expand on this more.


### Testing

Lib: **PHPUnit**

*You must have **phpunit** installed to run tests.*

To run the tests, execute the following command from the project root:

```bash
phpunit --bootstrap autoload.php tests
```

To run individual tests, specify the file name.

```bash
phpunit --bootstrap autoload.php tests/CalendarTest.php
```

### Build Documentation
Lib: **PHPDocumentor**(PHPDoc)

*You must have **phpdocumentor** installed to run the build.*

To run the build, simply run `phpdocumentor` from the project root.  The
documentation will be built to `reference/docs`
