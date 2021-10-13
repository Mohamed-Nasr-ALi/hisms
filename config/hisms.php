<?php
/*
 * HISMS config
 * auth [username][required] && [password][required]: include username and password
 * sender [required]: Msg Identifier
 * url [default]: to https://www.hisms.ws apis
 * response_lang [required]: get response handler in which lang - supported are(ar,en)*/
return [
    'auth'=>[
        'username'=>env('HISMS_USERNAME','xxx'),
        'password'=>env('HISMS_PASSWORD','xxx'),
    ],
    'sender'=>env('HISMS_SENDER','xxx'),
    'sender_url'=>'https://www.hisms.ws/api.php',
    'response_lang'=>'en' //en or ar allowed
];
