<?php

require dirname(__FILE__) . '/vendor/autoload.php';

function greet($name)
{
    $client = new Helloworld\GreeterClient('localhost:50051', [
        'credentials' => Grpc\ChannelCredentials::createInsecure(),
    ]);
    $request = new Helloworld\HelloRequest();
    $request->setName($name);
    list($reply, $status) = $client->SayHello($request)->wait();

    echo 'status code: ' . $status->code;
    if ($status->details) {
        echo ', details: ' . $status->details;
    }
    echo PHP_EOL;
    if ($status->metadata) {
        echo 'Meta data: ' . PHP_EOL;
        print_r($status->metadata);
    }

    return $reply->getMessage();
}

$name = !empty($argv[1]) ? $argv[1] : 'world';
echo greet($name) . PHP_EOL;
