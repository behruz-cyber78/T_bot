<?php

$GET_INPUT= file_get_contents('php://input');

const TOKEN= '1896915186:AAF5dpFkD608RTxNBoYbEViibsbEATFwVNM';
const API_URL='https://api.telegram.org/bot';

function printAnswer($str){
    echo "<pre>";
    print_r($str);
    echo "<pre>";
}

function getTelegramApi($method, $options = null){
    $str_request = API_URL . TOKEN . '/'.$method;

    if ($options) {
        $str_request .= '?' . http_build_query($options); 
    }
    $request = file_get_contents($str_request);

    return json_decode($request, 1);

}

function setHook($set = 1){
    $url = 'https://' . $_SERVER['HTTP_POST'] . $_SERVER['REQUEST_API'];
    printAnswer(
        getTelegramApi('setWebhook',
            [
                'url' => $set?$url:''
            ]        
        )
    )        
    exit();
} //setHook();

$event = json_decode($GET_INPUT, 1);

if (mb_strtolower($event['message']['text']) == 'hello') {
    $answer = 'hi';
}else{
    $answer = 'wtf?';
}

getTelegramApi('sendMessage',
    [
        'text'=> $answer,
        'chat_id' => $event['message']['chat_id']
    ]
)