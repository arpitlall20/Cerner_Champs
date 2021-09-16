<?php
function encryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}

/*
$input = "admin1";

$encrypted = encryptIt( $input );
$decrypted = decryptIt( $encrypted );  
echo "en=". $encrypted;
echo  "de=".$decrypted;    */  

//echo $decrypted = decryptIt('dkoYYmJRseMR6s2vRaG1i+0f9GW2Wy7aWCUzUc/GhtY=');    exit;
?>