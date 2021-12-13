<?php
namespace SevenEcks\StringUtils;

use SevenEcks\Ansi\Colorize;
use SevenEcks\Ansi\ColorInterface;

/**
 * This class is a utility package for manipulating strings in ways that. Specifically designed
 * for formatting terminal output and log output
 *
 * @author Brendan Butts <bbutts@stormcode.net>
 *
 */
class StringUtils
{
    protected $line_length = 180;
    protected $split_mid_word = false;
    protected $break_string = "\n";
    protected $eol_string = "\n";
    protected $colorize = null;

    /**
     * Construct the StringUtils object, accepting a class that defines the
     * ColorizeInterface, if it is not passed in, the constructor injects one
     * on it's own.
     *
     * @param interface $colorize;
     * @return void
     */
    public function __construct(ColorInterface $colorize = null)
    {
        if (!$colorize) {
            $colorize = new Colorize;
        }
        $this->colorize = $colorize;
    }

    /**
     * Display a string on the left, and pad it on the right $length
     * characters using $filler.
     *
     * @param string $string
     * @param int $length
     * @param optional string $filler
     * @return string
     */
    public function left($string, $length, $filler = ' ') 
    {
        return str_pad($string, $length, $filler, STR_PAD_RIGHT); 
    }

    /**
     * Display a string on the right, and pad it on the left $length
     * characters using $filler.
     *
     * @param string $string
     * @param int $length
     * @param optional string $filler
     * @return string
     */
    public function right($string, $length, $filler = ' ') 
    {
        return str_pad($string, $length, $filler, STR_PAD_LEFT); 
    }

    /**
     * Display a string in the center (passed in, or determined by the 
     * line_length / 2 - the length of the string being presented / 2
     * and pad it on the left $length and right as close to equal
     * characters using $filler / 2.
     *
     * @param string $string
     * @param optional int $length
     * @param optional string $filler
     * @return string
     */
    public function center($string, $length = null, $filler = ' ')
    {
        if (is_null($length)) {
            $length = ($this->line_length / 2) - (strlen($string) / 2);
        }
        return str_pad($string, $length, $filler, STR_PAD_BOTH);
    }

    /**
     * Create a string of $length with the filler characters $filler.
     * This function will return a string of length $length even if
     * $filler is greater than that length.
     *
     * @param int $length
     * @param string $filler
     * @return string
     */
    public function fill(int $length, string $filler = ' ')
    {
        return str_pad('', $length, $filler);
    }

    public function tableify(array $data, string $formatter = 'left', int $seperator_padding = 1, string $seperator = '|', string $header_character = '-', $below_header_character = '-')
    {
        // empty table to start
        $table = [];
        // get the max length of each column in the table
        $field_lengths = $this->maxMultidimensionalArrayStringSize($data);
        $row_length = $this->calculateRowLength($field_lengths, $seperator_padding, $seperator);
        $book_end = $this->fill($row_length, $header_character);
        $below_header = $this->fill($row_length, $below_header_character);
        $table[] = $book_end;
        // loop over each 'row' in our array
        for ($i = 0; $i < count($data); $i++) {
            // line starts as just the left most seperator
            $line = $seperator . $this->fill($seperator_padding);
            // loop over each 'field' aka column in our row
            for ($j = 0; $j < count($data[$i]); $j++) {
                // format the fields such that they have a max length of the biggest field in this column
                // and add the additional padding, then pass this to the formatter method and append it to
                // the line and then add the seperator
                $line .= $this->{$formatter}($data[$i][$j], $field_lengths[$j]) . $this->fill($seperator_padding) . $seperator . $this->fill($seperator_padding);
            }
            // add the new line to the table
            $table[] = $line;
            // if this was the first row we will add a $below_header row to break it up
            if ($i == 0) {
                $table[] = $below_header;
            }
        }
        $table[] = $book_end;
        return $table;
    }

    private function calculateRowLength(array $field_lengths, int $seperator_padding, string $seperator)
    {
        $sample_row = $seperator . $this->fill($seperator_padding);
        for ($i = 0; $i < count($field_lengths); $i++) {
            $sample_row .= $this->fill($field_lengths[$i]) . $this->fill($seperator_padding) . $seperator . $this->fill($seperator_padding);
        }
        $sample_row = rtrim($sample_row);
        return strlen($sample_row);
    }

    /**
     * For an array of length N and with each N having X columns find the max string length
     * for each column in the array, across dimensions such as [['aaaa','aaaaa'], ['bb','bbbbbbb']]
     * would yeild a return of [4, 7].
     *
     * @param array $data
     * @return array
     */
    public function maxMultidimensionalArrayStringSize(array $data)
    {
        $lengths = [];
        for ($i =0; $i < count($data); $i++) {
            for ($j = 0; $j < count($data[$i]); $j++) {
                $temp_length = strlen($data[$i][$j]);
                if (!isset($lengths[$j])) {
                    $lengths[$j] = $temp_length;
                    continue;
                } elseif ($lengths[$j] < $temp_length) {
                    $lengths[$j] = $temp_length;
                    continue;
                }
            }
        }
        return $lengths;        
    }

    /**
     * Break a string at $this->line_length
     * and return an array of strings
     *
     * @param string $string
     * @return array
     */
    public function lineWrap($string)
    {
        $lines = str_split($string, $this->line_length);
        return $lines;
    }

    /**
     * Echo or return a string ending in $this->eol_string
     *
     * @param string $string
     * @param bool $echo
     * @return string
     */
    public function tell(string $string, $echo = true)
    {
        $full_string = $string . $this->eol_string;
        if ($echo) {
            echo $full_string;
            return;
        }
        return $full_string;
    }

    /** 
     * Take n arguments and combine them into a single
     * string and return that string
     * @param string $strings
     * @param ... $strings
     * @return string
     */
    public function tostr(...$strings)
    {
        $new_string = '';
        foreach ($strings as $temp) {
            switch (gettype($temp)) {
                case "array":
                    $it = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($temp));
                    foreach($it as $v) {
                        $temp_str .= ' ' . $this->tostr($v);
                    }
                    break;
                default:
                    $temp_str = (string)$temp;
                    break;
            }
            $new_string .= $temp_str;
        }
        return trim($new_string);
    }

    /**
     * Take an array of $lines and execute
     * $this->tell on each line
     *
     * @return none
     */
    public function tell_lines(array $lines)
    {
        foreach ($lines as $line) {
            $this->tell($line);
        }
    }

    /**
     * Echo out a string wrapped either at a word, or close to the words completion
     *
     * @param string $string
     * @return none
     */
    public function wordWrap($string)
    {
        echo wordwrap($string, $this->line_length, $this->break_string, $this->split_mid_word);
    }

    /**
     * Setter for $this->split_mid_word
     *
     * @param bool $split_mid_word
     * @return none
     */
    public function setSplitMidWord(bool $split_mid_word)
    {
        $this->split_mid_word = $split_mid_word;
    }

    /**
     * Getter for $this->get_split_word
     *
     * @return bool
     */
    public function getSplitMidWord()
    {
        return $this->split_mid_word;
    }

    /**
     * Setter for $this->line_length which defines
     * the line length for wrapping
     *
     * @param int $new_line_length
     * @return none
     */
    public function setLineLength(int $new_line_length)
    {
        $this->line_length = $new_line_length;
    }

    /**
     * Getter for $this->line_length
     *
     * @return int
     */
    public function getLineLength()
    {
        return $this->line_length;
    }

    /**
     * Setter for $this->break_string which defines what wordwrap
     * uses for line breaks when executing
     *
     * @param string $break_string
     * @return none
     */
    public function setBreakString(string $break_string)
    {
        $this->break_string = $break_string;
    }

    /**
     * Getter for $this->break_string
     *
     * @return string
     */
    public function getBreakString()
    {
        return $this->break_string;
    }

    /**
     * Getter for $this->eol_string which defines what tell()
     * uses when echoing out a string
     *
     * @return string
     */
    public function getEolString()
    {
        return $this->eol_string;
    }

    /**
     * Setter for $this->eol_string
     *
     * @return none
     */
    public function setEolString(string $eol_string)
    {
        $this->eol_string = $eol_string;
    }

    /**
     * Display an alert string
     *
     * @param string $string
     * @return none
     */
    public function alert(string $string)
    {
        $this->tell('[' . $this->colorize->cyan('ALERT') . '] ' .  $string);
    }

    /**
     * Display a warning string
     *
     * @param string $string
     * @return none
     */
    public function warning(string $string)
    {
        $this->tell('[' . $this->colorize->yellow('WARNING') . '] ' . $string);
    }

    /**
     * Display a critical string
     *
     * @param string $string
     * @return none
     */
    public function critical(string $string)
    {
        $this->tell('[' . $this->colorize->red('CRITICAL') . '] ' . $string);
    }
}
