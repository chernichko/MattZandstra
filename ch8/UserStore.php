<?php
namespace ch8;

class UserStore
{
    private array $users = [];

    public function addUser(string $name, string $mail, string $pass): bool
    {
        if(isset($this->users[$mail])){
            throw new \Exception(
                "User {$mail} yet"
            );
        }
        if( strlen($pass) <5 ){
            throw new \Exception(
                "password is short"
            );
        }

        $this->users[$mail] = [
            'pass' => $pass,
            'mail' => $mail,
            'name' => $name
        ];
        return true;
    }
    public function notifyPasswordFailure(string $mail):void{
        if(isset($this->users[$mail]))
        {
            $this->users[$mail]['failed'] = time();
        }
    }

    public function getUser(string $mail): array
    {
        return ($this->users[$mail]);
    }

}

$store = new UserStore();
$store->addUser(
    "bob",
    "bob@mail.com",
    "12345"
);
$store->notifyPasswordFailure("bob@mail.com");
$user = $store->getUser("bob@mail.com");
print_r($user);