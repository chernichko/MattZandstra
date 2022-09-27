<?php
namespace tests;
use ch8\UserStore;
use ch8\Validator;
use \PHPUnit\Framework\TestCase;

require __DIR__ . "/../ch8/Validator.php";  //???

ini_set('display_errors',1);
error_reporting(E_ALL);

class ValidatorTest extends TestCase
{
    private Validator $validator;

    protected function setUp(): void
    {
        $store = new UserStore();
        $store->addUser("bob",
            "bob@mail.com",
            "12345");
        $this->validator = new Validator($store);
    }

    public function testValidateCorrectPass():void
    {
        $this->assertTrue(
            $this->validator->validateUser("bob@mail.com",
                "12345"),
            'wait success'
        );
    }

}