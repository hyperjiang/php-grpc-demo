<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: addressbook.proto

namespace Addressbook;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>addressbook.GetAddressBookResponse</code>
 */
class GetAddressBookResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.addressbook.AddressBook address_book = 1;</code>
     */
    private $address_book = null;

    public function __construct() {
        \GPBMetadata\Addressbook::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.addressbook.AddressBook address_book = 1;</code>
     * @return \Addressbook\AddressBook
     */
    public function getAddressBook()
    {
        return $this->address_book;
    }

    /**
     * Generated from protobuf field <code>.addressbook.AddressBook address_book = 1;</code>
     * @param \Addressbook\AddressBook $var
     * @return $this
     */
    public function setAddressBook($var)
    {
        GPBUtil::checkMessage($var, \Addressbook\AddressBook::class);
        $this->address_book = $var;

        return $this;
    }

}

