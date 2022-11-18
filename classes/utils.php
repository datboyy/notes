<?php
class Utils
{

  public static function parse_code_blocks(string $text) : string
  {
    $text = preg_replace_callback('#<code>(.+)</code>#isU', function($matches)
    {
      return '<code>' . trim(htmlentities($matches[1])) . '</code>';
    }, $text);
    return  $text;
  }
}
// EOF
