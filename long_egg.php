<?php

include __DIR__.'/MD5.php';
$inFile = __DIR__.'/demo';
$dummyText = str_pad('', 64, 'A');

function replaceDummyText($input, $replacment, $position)
{
    return substr_replace($input, $replacment, $position, strlen($replacment));
}

function findDummyText($filestring, $dummyText)
{   
    $pos = 0;
    $chunks = str_split($filestring, 64);
    foreach ($chunks as $chunk) {
        if ($chunk == $dummyText)  {
            break 1;
        }
        $pos++;
    }
    return $pos*64;
}

// read in the original binary file in
$filestring = file_get_contents($inFile);

// find the place where we have the dummy string and its at start of a 64 byte block
$pos = findDummyText($filestring, $dummyText);
printf('I want to replace %d bytes at position %d in %s'.PHP_EOL, 128, $pos, $inFile);
$firstPart = substr($filestring, 0, $pos);

//find the IV up to the point we want to insert then print that out
$iv = md5_hash($firstPart);
printf('Chainring variable up to that point is %s'.PHP_EOL, $iv);

if (!file_exists(__DIR__.'/a')) {
    print('Run fastcoll to generate a 2 block collision in MD5'.PHP_EOL);
    return;
}

// replace the dummy text at the correct location
$good = replaceDummyText($filestring, file_get_contents(__DIR__.'/a'), $pos);
$bad  = replaceDummyText($filestring, file_get_contents(__DIR__.'/b'), $pos);

// find the second dummy string
$secondDummyTextStart = strpos($good, str_pad('', 191, 'A'));

// search back from where we inserted the collision first time so we can grab the whole
// 192 bytes and use it to replace the second string
while ('A' == substr($filestring, $pos-1, 1)) {
    --$pos;
}

//the 192 bytes of str1
$replacement = substr($good, $pos, 192);

// replace str1 with 192 bytes cut from of the files
// the file it came from will then compare str1 and str2 to 0
$good = replaceDummyText($good, $replacement, $secondDummyTextStart);
file_put_contents(__DIR__.'/devil', $good);
printf('Just output new file %s with hash %s'.PHP_EOL, __DIR__.'/devil', md5($good));

$bad = replaceDummyText($bad, $replacement, $secondDummyTextStart);
file_put_contents(__DIR__.'/angel', $bad);
printf('Just output new file %s with hash %s'.PHP_EOL, __DIR__.'/angel', md5($bad));
