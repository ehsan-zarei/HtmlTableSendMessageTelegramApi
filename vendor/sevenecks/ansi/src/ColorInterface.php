<?php
namespace SevenEcks\Ansi;

/**
 * Define an interface for describing ANSI colored text
 *
 * @author Brendan Butts <brendan@alipes.com>
 */
interface ColorInterface
{
    /**
     * Dynamically call the static methods from instance variables
     * and provide the correct arguments as needed
     *
     * @param string $name
     * @param array $arguments
     * @return string
     */
    public function __call($name, $arguments);
    /**
     * Colorize a string of text and return it
     *
     * @param string $text
     * @param string $color
     *
     * @return string
     */
    public static function colorizeString($text, $color);
    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function black($text);

    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function darkGray($text);

    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function blue($text);
    
    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function lightBlue($text);
    
    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function green($text);
    
    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function lightGreen($text);
    
    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function cyan($text);
    
    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function lightCyan($text);
    
    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function red($text);
    
    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function lightRed($text);
    
    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function purple($text);

    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function lightPurple($text);
    
    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function brown($text);
    
    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function yellow($text);
    
    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function lightGray($text);
    
    /**
     * Colorize the foreground of a string
     *
     * @param string $text
     * @return string
     */
    public static function white($text);

    /**
     * Colorize the background of a string
     *
     * @param string $text
     * @return string
     */
    public static function bgBlack($text);

    /**
     * Colorize the background of a string
     *
     * @param string $text
     * @return string
     */
    public static function bgRed($text);
    
    /**
     * Colorize the background of a string
     *
     * @param string $text
     * @return string
     */
    public static function bgGreen($text);
    
    /**
     * Colorize the background of a string
     *
     * @param string $text
     * @return string
     */
    public static function bgYellow($text);
    
    /**
     * Colorize the background of a string
     *
     * @param string $text
     * @return string
     */
    public static function bgBlue($text);
    
    /**
     * Colorize the background of a string
     *
     * @param string $text
     * @return string
     */
    public static function bgMagenta($text);
    
    /**
     * Colorize the background of a string
     *
     * @param string $text
     * @return string
     */
    public static function bgCyan($text);
    
    /**
     * Colorize the background of a string
     *
     * @param string $text
     * @return string
     */
    public static function bgLightGray($text);
}
