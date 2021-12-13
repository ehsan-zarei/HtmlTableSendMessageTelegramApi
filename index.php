<?php
require_once './vendor/autoload.php';
use SevenEcks\Tableify\Tableify;
//this function send text message

//call
SendSimpleMessage("Hi");

SendMessage("this html message");

SendTableMessage();



function SendSimpleMessage($message)
{
    Send($message);
}
//this function for send html text
function SendMessage($message)
{
    $message = "<b><u>" . $message . "</u></b>";
    Send($message);
}
//this function for send data array with table template
function SendTableMessage()
{
    $tableMessage = '';
    //this array sample data
    // first record use for header table
    $data = [
        ['Name', 'Date', 'Phone', 'Age'],
        ['Altec Lansing', '03/22/18', '617-555-0584', '30'],
        ['Fack', '03/22/18', '508-555-0584', '24'],
        ['Seven Ecks', '03/22/18', '+1-888-555-0584', '100'],
        ['CK', '03/22/18', 'N/A', '33'],
        ['Jason Jasonson', '03/22/18', '978-555-0584', '34'],
        ['Waxillium Wick', '03/22/18', '978-555-0584', '34'],
        ['Ruby Reide', '03/22/18', '978-555-0584', '34'],
        ['Rex Gold', '03/22/18', '978-555-0584', '34'],
        ['Juicy Vee', '03/22/18', '978-555-0584', '34'],
    ];

    echo "Table Construction using default values on class and no method chaining:\n";
    $table = Tableify::new($data);
    $table = $table->make();
    $table_data = $table->toArray();
    foreach ($table_data as $row) {
        $tableMessage .= $row . "\n";
    }
    $tableMessage = "<pre>" . $tableMessage . "</pre>";
    Send($tableMessage);
}
//this function for send Request to Api telegram
function Send($message)
{
    $chat_id = '';
    $token = '';
    $url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text=" . urlencode($message);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $html = curl_exec($ch);
    var_dump($html);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// echo "Output:".$html;  // you can print the output for troubleshooting
    curl_close($ch);
}







