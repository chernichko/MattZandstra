<?php
namespace tests;
use ch8\UserStore;
use \PHPUnit\Framework\TestCase;

require __DIR__ . "/../ch8/UserStore.php";  //???

ini_set('display_errors',1);
error_reporting(E_ALL);

class UserStoreTest extends TestCase
{
    private UserStore $store;
    protected function setUp():void{
        $this->store = new UserStore();
    }

    protected function tearDown():void{

    }

    public function testGetUser():void{
        $this->store->addUser('nick', 'nick@mail.com', '12345');
        $user = $this->store->getUser('nick@mail.com');
        $this->assertEquals('nick@mail.com', $user['mail']);
        $this->assertEquals('nick', $user['name']);
        $this->assertEquals('12345', $user['pass']);
    }

    public function testAddUserShortPass(): void
    {
//        $this->expectException(\Exeption::class); ??
//        $this->store->addUser("name", "email","1234");

        try {
            $this->store->addUser("name", "email","1234");
        }
        catch (\Exception $e)
        {
            $this->assertEquals(
                "password is short",
                $e->getMessage()
            );
            return;
        }

        $this->fail("text text");
    }
}