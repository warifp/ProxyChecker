<?php
error_reporting(0);
/**
 * Author  : Wahyu Arif Purnomo
 * Name    : Proxy Checker
 * Version : 1.0
 * Update  : 14 June 2019
 * 
 * If you are a reliable programmer or the best developer, please don't change anything.
 * If you want to be appreciated by others, then don't change anything in this script.
 * Please respect me for making this tool from the beginning.
 */

/** Library */
require_once('vendor/autoload.php');
$climate = new League\CLImate\CLImate;
require_once('modules/config.php');

$save_die = "die.txt";
$save_live = "live.txt";

$input_list = $climate->info()->input('List?');
$list = $input_list->prompt();

$climate->br()->info('Start check your proxy list ..');
progress($progress);
$file = file_get_contents("$list");
$data = explode("\n", str_replace("\r", "", $file));
$no = 0;
for ($a = 0; $a < count($data); $a++) {
    $proxy   = $data[$a];
    $no++;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://checkerproxy.net/api/check');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"type\":2,\"timeout\":20,\"publish\":false,\"proxies\":[\"$proxy\"]}");
    curl_setopt($ch, CURLOPT_POST, 1);
    
    $headers   = array();
    $headers[] = 'Host: checkerproxy.net';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Content-Length: 73';
    $headers[] = 'Origin: https://checkerproxy.net';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36';
    $headers[] = 'UContent-Type: text/plain;charset=UTF-8';
    $headers[] = 'Accept: */*';
    $headers[] = 'Referer: https://checkerproxy.net/';
    $headers[] = 'Accept-Encoding: gzip, deflate, br';
    $headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    curl_close($ch);
    $decode = json_decode($result);
    $error = $decode->error;
    if($error == "couldn't read payload"){
        $climate->error( $no . '. ' . $proxy . ' ==> Die | Response :' . $error . '');
        $save = fopen($save_die, 'a');
        fwrite($save, $proxy . "\n");
    } else {
        $climate->info( $no . '. ' . $proxy .  ' ==> Live | Response : ' . $result . '');
        $save = fopen($save_live, 'a');
        fwrite($save, $proxy . "\n");
    }
}
$climate->br()->shout('Done, your result live saved in folder : "' . $save_live . '" and result die saved in folder "' . $save_die .'".');

/**
 * Author  : Wahyu Arif Purnomo
 * Name    : Proxy Checker
 * Version : 1.0
 * Update  : 14 June 2019
 * 
 * If you are a reliable programmer or the best developer, please don't change anything.
 * If you want to be appreciated by others, then don't change anything in this script.
 * Please respect me for making this tool from the beginning.
 */
?>