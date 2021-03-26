<?php
$patterns = [
    'phone' => [
        'regex' => '/^((\+?38)?\(?[0-9]{3}\)?[\s\-]?(\d{7}|\d{3}[\s\-]\d{2}[\s\-]\d{2}|\d{3}-\d{4}))\b/',
        'callback'=> function (array $data) {
            
            $number = $data[0];
            $digitcount = preg_match_all("/[0-9]/", $number);

            if ($digitcount == 10) {
                $number = '+38'.$number;
            } else if (substr($number, 0, 1) != "+") {
                $number = '+'.$number;
            }
            return $number;
        }
    ],
    'name' => [
        'regex' => '/^[a-zA-Zа-яґєіїёА-ЯҐЄІЇЁ\']+$/u'
    ],
    'email' => [
        'regex' => '/^[-0-9a-zA-Z.+-_&#=?^\/{|}~!{2}]+@[-0-9a-zA-Z.+-_&#=?^\/{|}~!{2}]+.[a-zA-Z]{2,6}/'
    ],
];