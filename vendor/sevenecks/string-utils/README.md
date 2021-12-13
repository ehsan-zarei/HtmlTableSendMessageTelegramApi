# StringUtils

A set of common string functions, loosely based on LambdaMOO $string_utils. It uses [sevenecks/ansi](https://github.com/SevenEcks/ansi) to add color where applicable though you can pass your own colorizer in via dependency injection.

## Installation

Via Composer

```bash
composer require sevenecks/string-utils
```

## Usage

You can use this by calling it's static methods, or instantiate it as an object and call it's methods dynamically.

```php
require_once __DIR__ . '/vendor/autoload.php';
use SevenEcks\StringUtils\StringUtils;
use SevenEcks\Ansi\Colorize;

$su = new StringUtils();

$colorize = new Colorize;
$su2 = new StringUtils($colorize);

$test_string = 'This is a test';
$su->tell($test_string);
$su->setLineLength(10);
$su->tell(Colorize::red("This is a test of a long red string!"));
$su->setSplitMidWord(true);
$su->tell(Colorize::blue("This is a test of a long blue word wrapped string which breaks mid word!"));
$su->setSplitMidWord(false);
$su->tell(Colorize::blue("This is a test of a long blue word wrapped string which breaks at a word!"));
$su->setBreakString("<br />");
$su->tell(Colorize::red("This is a test of a long red string!"));
$su->tell("Not colored.");
$su->tell_lines($su->lineWrap("This is a test of a long red wrapped string!"));
$su->tell_lines($su->lineWrap('123456789123456789123456789'));
$su->tell($su->left("TEST", 10) . $su->left("TEST1", 10));
$su->tell($su->right("TEST", 10) . $su->right("TEST1", 10));
$su->tell($su->center("TEST", 10) . $su->center("TEST1", 10));
// using tostr to combine args into a string
$su->tell($su->tostr($su->center("THIS EXAMPLE", 10), ' ', $su->center("USES TOSTR", 10), ' ', 1,2,3));
$su->alert("This is an alert!");
$su->warning("This is a warning");
$su->critical("This is critical!");
$a = $su->tell("RETURN THIS STRING!", false);
```
![Example Output](https://github.com/SevenEcks/string-utils/blob/master/images/example.png "Example Output")

## Change Log
Please see [Change Log](CHANGELOG.md) for more information.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
