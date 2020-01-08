<?php
error_reporting(0);
/**
 * Author  : Wahyu Arif Purnomo
 * Name    : Proxy Checker
 * Version : 2.0
 * Update  : 08 Januari 2020
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
$file = file_get_contents("$list") or die ("" . $climate->br()->error('File not found. Check the file name and try again.') . "");
$data = explode("\n", str_replace("\r", "", $file));
$no = 0;
for ($a = 0; $a < count($data); $a++) {
    $proxy   = $data[$a];
    $no++;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://checkip.dyndns.org/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    
    $result = curl_exec($ch);
    curl_close($ch);
    if($result == "error code: 1001"){
        $climate->error( $no . '. Die  | ' . $proxy);
        $save = fopen($save_die, 'a');
        fwrite($save, $proxy . "\n");
    } else if($result == null){
        $climate->error( $no . '. Die  | ' . $proxy);
        $save = fopen($save_die, 'a');
        fwrite($save, $proxy . "\n");
    } else {
        $climate->info( $no . '. Live | ' . $proxy);
        $save = fopen($save_live, 'a');
        fwrite($save, $proxy . "\n");
    }
}
$climate->br()->info('Done, your result live saved in folder : "' . $save_live . '" and result die saved in folder "' . $save_die .'".');

/**
 * Author  : Wahyu Arif Purnomo
 * Name    : Proxy Checker
 * Version : 2.0
 * Update  : 08 Januari 2020
 * 
 * If you are a reliable programmer or the best developer, please don't change anything.
 * If you want to be appreciated by others, then don't change anything in this script.
 * Please respect me for making this tool from the beginning.
 */
?>
