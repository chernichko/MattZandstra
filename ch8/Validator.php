<?php
namespace ch8;
require "UserStore.php";
ini_set('display_errors',1);
error_reporting(E_ALL);

class Validator
{
    private object $store;

    public function __construct( $user){
        $this->store = $user;
    }

//    public function __construct( UserStore $store){}

    public function validateUser(string $mail, string $pass): bool
    {
        if(! is_array($user = $this->store->getUser($mail)))
        {
            return false;
        }

        if($user['pass'] == $pass)
        {
            return true;
        }

        $this->store->notifyPasswordFailure($mail);
        return false;
    }
}

$store = new UserStore();
$store->addUser("bob",
    "bob@mail.com",
    "12345");

$validator = new Validator($store);

if($validator->validateUser(
    "bob@mail.com",
"12345")
)
{
    print 'hi, gay!'."\n";
}