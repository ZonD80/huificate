<?php
/**
 * Created by PhpStorm.
 * User: ZonD80
 * Date: 27.06.2016
 * Time: 13:30
 */

/**
 * This is the test case
 */

require_once 'huificate.inc.php';

$text = 'тест ебаного хуификатора, во блядь, сука!';

var_dump(huificate($text));