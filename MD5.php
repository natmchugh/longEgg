<?php

//Pre-processing: adding a single 1 bit
// append "1" bit to message
// Notice: the input bytes are considered as bits strings,
//  where the first bit is the most significant bit of the byte.[46]
//Pre-processing: padding with zeros
// append "0" bit until message length in bits ≡ 448 (mod 512)
function preProcess($message) {
    // $message .= chr(128);
    // while (((strlen($message) + 8) % 64) !== 0) {
    //     $message .= chr(0);
    // }
    return $message;
}

function getShiftsAndConstants() {
    //s specifies the per-round shift amounts
    $s = [ 7, 12, 17, 22,  7, 12, 17, 22,  7, 12, 17, 22,  7, 12, 17, 22,
     5,  9, 14, 20,  5,  9, 14, 20,  5,  9, 14, 20,  5,  9, 14, 20,
     4, 11, 16, 23,  4, 11, 16, 23,  4, 11, 16, 23,  4, 11, 16, 23,
     6, 10, 15, 21,  6, 10, 15, 21,  6, 10, 15, 21,  6, 10, 15, 21];

    $K = [];
    for ($i =0; $i < 64; $i++) {
        $K[$i] = floor(abs(sin($i + 1)) * (pow(2, 32))) & 0xffffffff;
    }
    return [$s, $K];
}

//Process the message in successive 512-bit chunks:
function md5_hash($message) {

    //Initialize variables:
    list($a, $b, $c, $d) = [0x67452301, 0xefcdab89, 0x98badcfe, 0x10325476];
    list($s, $K) = getShiftsAndConstants();
    // append original length in bits mod (2 pow 64) to message
    $originalSize = strlen($message) * 8;
    $message = preProcess($message);

    // break chunk into sixteen 32-bit words M[j], 0 ≤ j ≤ 15
    $chunks = str_split($message, 64);
    foreach ($chunks as $chunk) {
        list($aa, $bb, $cc, $dd) = [$a, $b, $c, $d];
        $words = str_split($chunk, 4);
        foreach ($words as $i => $chrs) {
            $chrs = str_split($chrs);
            $word = '';
            //little endian
            $chrs = array_reverse($chrs);
            foreach ($chrs as $chr) {
                $word .= sprintf('%08b', ord($chr));
            }
            $words[$i] = bindec($word);
    }
    // if (count($words) < 16) {
    //     $words[] = 0x00000000ffffffff & $originalSize;
    //     $words[] = 0xffffffff00000000 & $originalSize;
    // }
//Main loop:
    for ($i = 0; $i < 64; $i++) {
        $step = floor($i /16);
        switch ($step) {
            case 0;
                $f = ($b & $c) | (~$b & $d);
                $g = $i;
                break;
            case 1;
                $f = ($d & $b) | (~$d & $c);
                $g = (5 * $i + 1) % 16;
                break;
            case 2;
                $f = $b ^ $c ^ $d;
                $g = (3 * $i + 5) % 16;
                break;
            case 3;
                $f = $c ^ ($b | ~$d);
                $g = (7 * $i) % 16;
                break;
        }
        $temp = $d;
        $d = $c;
        $c = $b;
        $b = $b + rotl(($a + $f + $K[$i] + $words[$g]) & 0xffffffff, $s[$i]) ;
        $a = $temp;
    }
//Add this chunk's hash to result so far:
        $a = $a + $aa & 0xffffffff;
        $b = $b + $bb & 0xffffffff;
        $c = $c + $cc & 0xffffffff;
        $d = $d + $dd & 0xffffffff;
    }
    $x = pack('V4', $a, $b, $c, $d);
    return bin2hex($x);
}

//leftrotate function definition
function rotl ($x, $c)
{
    return ($x << $c) | ($x >> (32 - $c));
}