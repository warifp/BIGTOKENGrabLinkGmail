<?php

    $email = array(
            'host' 		=> '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX',
            'username' 	=> 'masukkan email',
            'password' 	=> 'masukkan password'
        );

     $read = imap_open($email['host'],$email['username'],$email['password']);
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