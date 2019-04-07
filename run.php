<?php

echo "
########################################
Jangan lupa donasi!\n
> Paypal : paypal.me/wahyuarifpurnomo\n
> OVO\t: 087719090011\n
Terimakasih banyak yang sudah donasi :')
########################################\n\n";

    $host = "{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX";
    echo "Email \t\t: ";
    $email = trim(fgets(STDIN)) or die("!email harus di isi dengan benar.");
    echo "Password \t: ";
    $password = trim(fgets(STDIN)) or die("!password harus di isi dengan benar.");
    echo "Sedang mengambil link target.";

    $read = imap_open($host,$email,$password);
    $array = imap_search($read,'SUBJECT "BIGtoken"');
     
    foreach($array as $a){
        $header = imap_header($read, $a);
        $html = imap_qprint(imap_fetchbody($read, $a, 1));
        
        $dom = new DOMDocument;
        @$dom->loadHTML($html);
        $links = $dom->getElementsByTagName('a');
        $link = $links[1]->getAttribute('href')."\n";  
        file_put_contents('link.txt', $link, FILE_APPEND | LOCK_EX);
     }
     echo "Selesai mengambil link target.";
     echo "Link tersimpan di [link.txt]";
?>