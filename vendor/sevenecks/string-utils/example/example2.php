<?php
require_once __DIR__ . '/../vendor/autoload.php';
use SevenEcks\StringUtils\StringUtils;
use SevenEcks\Ansi\Colorize;

$colorize = new Colorize;
$su = new StringUtils($colorize);
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
// testing tableify and array to string conversion
$data = [
    ['Name', 'Date', 'Phone', 'Age'], 
    ['Brendan Butts', '03/22/18', '978-555-0584', '34'],
    ['Brendan Butts', '03/22/18', '978-555-0584', '34'],
    ['Brendan Butts', '03/22/18', '978-555-0584', '34'],
    ['Brendan Butts', '03/22/18', '978-555-0584', '34'],
    ['Brendan Butts', '03/22/18', '978-555-0584', '34'],
    ['Brendan Butts', '03/22/18', '978-555-0584', '34'],
    ['Brendan Butts', '03/22/18', '978-555-0584', '34'],
    ['Brendan Butts', '03/22/18', '978-555-0584', '34'],
    ['Brendan Butts', '03/22/18', '978-555-0584', '34'],
];
$su->tell_lines($su->tableify($data, 'left', 1, '|', '-', '-'));
// testing tostr of an array
$su->tell("tostr of an array:");
$su->tell($su->tostr($data));


