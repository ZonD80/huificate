<?php
/**
 * Created by PhpStorm.
 * User: ZonD80
 * Date: 27.06.2016
 * Time: 13:25
 */

/**
 * This function actually huficates text
 * @param string $text Text to huify
 * @return bool|string False if nothing to huificate, huificated text on success.
 */

function huificate($text)
{
    $matched = preg_match_all('/\b(\w{3,100})\b/iu', $text, $to_huify);

    if (!$matched) {
        return false;
    }

    $letter_replacements = array(
        'а' => 'я',
        'о' => 'ё',
        'ы'=>'е',
    );
    foreach ($to_huify[0] as $th) {
        $matched_letters = preg_match_all('/[а-я]/iu', $th, $letters);
        if (!$matched_letters) {
            continue;
        }
        $letters = $letters[0];
        $first_letter = array_shift($letters);
        $second_letter = array_shift($letters);
        $third_letter = array_shift($letters);
        if ($second_letter != 'у') {
            if (preg_match('/(а|е|ё|и|о|у|ы|э|ю|я)/ui', $second_letter)) { // glasnaya
                $text = preg_replace('/(^| )' . $th . '/iu', ' ху' . ($letter_replacements[$second_letter] ? $letter_replacements[$second_letter] : $second_letter) . $third_letter . implode('', $letters), $text);

            } else {
                if (preg_match('/(а|е|ё|и|о|у|ы|э|ю|я)/ui', $third_letter)) {
                    $text = preg_replace('/(^| )' . $th . '/iu', ' ху' . ($letter_replacements[$third_letter] ? $letter_replacements[$third_letter] : $third_letter) . implode('', $letters), $text);
                } else {
                    $text = preg_replace('/(^| )' . $th . '/iu', ' ху' . implode('', $letters), $text);

                }
            }
        } else {
            if ($third_letter != 'ю') {

                $text = preg_replace('/(^| )' . $th . '/iu', ' хую' . $third_letter . implode('', $letters), $text);
            } else {
                $text = preg_replace('/(^| )' . $th . '/iu', ' х' . $second_letter . ($letter_replacements[$third_letter] ? $letter_replacements[$third_letter] : $third_letter) . implode('', $letters), $text);
            }
        }
    }

    return $text;

}