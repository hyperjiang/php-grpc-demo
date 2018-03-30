<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Addressbook;

/**
 * The addressbook service definition.
 */
class AddressBookServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Add a person to address book
     * @param \Addressbook\AddPersonRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function AddPerson(\Addressbook\AddPersonRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/addressbook.AddressBookService/AddPerson',
        $argument,
        ['\Addressbook\AddPersonResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * Get the address book
     * @param \Addressbook\GetAddressBookRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function GetAddressBook(\Addressbook\GetAddressBookRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/addressbook.AddressBookService/GetAddressBook',
        $argument,
        ['\Addressbook\GetAddressBookResponse', 'decode'],
        $metadata, $options);
    }

}
