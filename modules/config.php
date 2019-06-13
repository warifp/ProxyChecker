<?php
$progress = $climate->progress()->total(100);
function progress($progress) {

for ($i = 0; $i <= 100; $i++) {
    $progress->current($i);
  
    // Simulate something happening
    usleep(10000);
  }
}
/** End Library */

$banner = "
           ___,             
       _.-'` __|__          
     .'  ,-:` \;',`'-,      
    /  .'-;_,;  ':-;_,'.    ################################
   /  /;   '/    ,  _`.-\   # Author  : Wahyu Arif Purnomo #
  |  | '`. (`     /` ` \`|  # Create  : 14 June 2019       #
  |  |:.  `\`-.   \_   / |  # Update  : 14 June 2019       #
  |  |     (   `,  .`\ ;'|  # Version : 1.0                #
   \  \     | .'     `-'/   # Name    : Proxy Checker      #
    \  `.   ;/        .'    ################################
     '._ `'-._____.-'`     
        `-.____|            
          _____|_____       
 WARIFP  /___________\    
   
[!] proxy checker to check the status of the ip-port proxy list

";
print $banner;