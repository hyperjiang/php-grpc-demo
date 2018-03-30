<?php

require dirname(__FILE__) . '/vendor/autoload.php';

$client = new AddressBook\AddressBookServiceClient('localhost:50051', [
    'credentials' => Grpc\ChannelCredentials::createInsecure(),
]);

function generate_string($length = 5)
{
    $nps = "";
    for ($i = 0; $i < $length; $i++) {
        $nps .= chr(mt_rand(97, 122));
    }
    return $nps;
}

function generate_number($length = 8)
{
    $n = "";
    for ($i = 0; $i < $length; $i++) {
        $n .= mt_rand(1, 9);
    }
    return $n;
}

$add_person = function () use ($client) {

    $name = generate_string(5);

    $person = new Addressbook\Person();
    $person->setName($name);
    $person->setEmail($name . '@foo');

    $phones = [];
    $num    = mt_rand(1, 3);
    for ($i = 0; $i < $num; $i++) {
        $phone = new Addressbook\Person_PhoneNumber();
        $phone->setType(mt_rand(1, 3));
        $phone->setNumber(generate_number());
        $phones[] = $phone;
    }
    $person->setPhones($phones);

    $request = new AddressBook\AddPersonRequest();
    $request->setPerson($person);
    list($reply, $status) = $client->AddPerson($request)->wait();

    echo 'status code: ' . $status->code;
    if ($status->details) {
        echo ', details: ' . $status->details;
    }
    echo PHP_EOL;
    if ($status->metadata) {
        echo 'Meta data: ' . PHP_EOL;
        print_r($status->metadata);
    }

    echo $reply->getMessage() . PHP_EOL;
};

$list_person = function () use ($client) {
    $request              = new AddressBook\GetAddressBookRequest();
    list($reply, $status) = $client->GetAddressBook($request)->wait();

    echo 'status code: ' . $status->code;
    if ($status->details) {
        echo ', details: ' . $status->details;
    }
    echo PHP_EOL;
    if ($status->metadata) {
        echo 'Meta data: ' . PHP_EOL;
        print_r($status->metadata);
    }

    $book = $reply->getAddressBook();
    foreach ($book->getPeople() as $people) {
        printf("ID: %d\n", $people->getId());
        printf("Name: %s\n", $people->getName());
        printf("Email: %s\n", $people->getEmail());
        echo "Phones: ";
        foreach ($people->getPhones() as $phone) {
            printf("[%d] %s, ", $phone->getType(), $phone->getNumber());
        }
        echo PHP_EOL;
        printf("Updated at: %s\n", $people->getLastUpdated()->toDateTime()->format('Y-m-d H:i:s'));
    }
};

$add_person();
$list_person();
