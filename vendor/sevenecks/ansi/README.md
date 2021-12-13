## Installation
```bash
composer require sevenecks/ansi
```

## Colorize

### Usage

#### Static Usage
The methods on Colorize can be called statically and the full API is listed later. 

```php
require_once __DIR__ . '/vendor/autoload.php';
use SevenEcks\Ansi\Colorize;

$test_string = 'This is a test';

echo Colorize::italic($test_string) . "\n";
echo Colorize::cyan($test_string) . "\n";
echo Colorize::bgRed($test_string) . "\n";
// background color first
echo Colorize::cyan(Colorize::bgRed($test_string)) . "\n";
// manually call the colorize string function
echo Colorize::colorizeString("TEST STRING", Colorize::$FOREGROUND_BLUE);
```

#### Instantiated Usage
Colorize also supports a magic method that will allow you to call the static methods dynamically, if you want to instantiate the Colorize class. This can be useful for dependency injection.

```php
require_once __DIR__ . '/vendor/autoload.php';
use SevenEcks\Ansi\Colorize;

$test_string = 'This is a test';

$colorize = new Colorize;

echo $color->red('tester');
echo $color->darkGray('testy mctesterson');
```

### Colors

There are several colors available for foreground and background.

#### Foreground

Colorize::italic
Colorize::bold
Colorize::underline
Colorize::invert
Colorize::darkGray
Colorize::blue
Colorize::lightBlue
Colorize::green
Colorize::lightGreen
Colorize::cyan
Colorize::lightCyan
Colorize::red
Colorize::lightRed
Colorize::purple
Colorize::lightPurple
Colorize::brown
Colorize::yellow
Colorize::lightGray
Colorize::white

#### Background

Colorize::bgBlack
Colorize::bgRed
Colorize::bgGreen
Colorize::bgYellow
Colorize::bgBlue
Colorize::bgMagenta
Colorize::bgCyan
Colorize::bgLightGray

## API
```php
//foreground colors
public static $FOREGROUND_BLACK = '0;30';
public static $FOREGROUND_DARK_GRAY = '1;30';
public static $FOREGROUND_BLUE = '0;34';
public static $FOREGROUND_LIGHT_BLUE = '1;34';
public static $FOREGROUND_GREEN = '0;32';
public static $FOREGROUND_LIGHT_GREEN = '1;32';
public static $FOREGROUND_CYAN = '0;36';
public static $FOREGROUND_LIGHT_CYAN = '1;36';
public static $FOREGROUND_RED = '0;31';
public static $FOREGROUND_LIGHT_RED = '1;31';
public static $FOREGROUND_PURPLE = '0;35';
public static $FOREGROUND_LIGHT_PURPLE = '1;35';
public static $FOREGROUND_BROWN = '0;33';
public static $FOREGROUND_YELLOW = '1;33';
public static $FOREGROUND_LIGHT_GRAY = '0;37';
public static $FOREGROUND_WHITE = '1;37';
public static $FOREGROUND_BOLD = '1';
public static $FOREGROUND_UNDERLINE = '4';
public static $FOREGROUND_ITALIC = '3'; 
public static $FOREGROUND_INVERT = '7';
public static $FOREGROUND_STRIKEOUT = '9';

// background colors 
public static $BACKGROUND_BLACK = '40';
public static $BACKGROUND_RED = '41';
public static $BACKGROUND_GREEN = '42';
public static $BACKGROUND_YELLOW = '43';
public static $BACKGROUND_BLUE = '44';
public static $BACKGROUND_MAGENTA = '45';
public static $BACKGROUND_CYAN = '46';
public static $BACKGROUND_LIGHT_GRAY = '47'; 

/**
 * Dynamically call the static methods from instance variables
 * and provide the correct arguments as needed
 *
 * @param string $name
 * @param array $arguments
 * @return string
 */
public function __call($name, $arguments)

/**
* Colorize a string of text and return it
*
* @param string $text
* @param string $color
*
* @return string
*/
public static function colorizeString($text, $color) 

/**
 * strikethrough some text 
 *
 * @param string $text
 * @return string
 */
public static function strikeout($text)

/**
 * invert the foreground of a string
 *
 * @param string $text
 * @return string
 */
public static function invert($text)

/**
 * bold the foreground of a string
 *
 * @param string $text
 * @return string
 */
public static function bold($text)

/**
 * Italic the foreground of a string
 *
 * @param string $text
 * @return string
 */
public static function italic($text)

/**
 * Underline the foreground of a string
 *
 * @param string $text
 * @return string
 */
public static function underline($text)

/**
* Colorize the foreground of a string
*
* @param string $text
* @return string
*/
public static function black($text)
public static function darkGray($text)
public static function blue($text)
public static function lightBlue($text)
public static function green($text)
public static function lightGreen($text)
public static function cyan($text)
public static function lightCyan($text)
public static function red($text)
public static function lightRed($text)
public static function purple($text)
public static function lightPurple($text)
public static function brown($text)
public static function yellow($text)
public static function lightGray($text)
public static function white($text)

/**
 * Colorize the background of a string
 *
 * @param string $text
 * @return string
 */
public static function bgBlack($text)
public static function bgRed($text)
public static function bgGreen($text)
public static function bgYellow($text)
public static function bgBlue($text)
public static function bgMagenta($text)
public static function bgCyan($text)
public static function bgLightGray($text)

## ColorInterface

You can use the ColorInterface.php file to implement your own ANSI Colorization class. The interface requires all the functions that the Colorize class implements, but does not care about how you define your colors or what is going on below the hood.

```
## Change Log
Please see [Change Log](CHANGELOG.md) for more information.

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
