<?php
function encrypto($str)
{
    $kunci = '22alslsykoe8741s1xzzsapoleid9192';
    $hasil = '';
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
        $karakter = chr(ord($karakter) + ord($kuncikarakter));
        $hasil .= $karakter;
    }
    return urlencode(base64_encode($hasil));
}

function decrypto($str)
{
    $str = base64_decode(urldecode($str));
    $hasil = '';
    $kunci = '22alslsykoe8741s1xzzsapoleid9192';
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
        $karakter = chr(ord($karakter) - ord($kuncikarakter));
        $hasil .= $karakter;
    }
    return $hasil;
}
