<?php

trait AppUserAuthentication {
    function authenticate(string $name, string $password ) {
        if (!empty($name) AND !empty($password)) {
            echo 'Привет пользователь приложения: ' . $name . '<br/>';
        } else {
            echo 'Привет гость приложения' . '<br/>';
        }
    }
}

trait MobileUserAuthentication {
    function authenticate(string $name, string $password ) {
        if (!empty($name) && !empty($password)) {
            echo 'Привет пользователь сайта: ' . $name . '<br/>';
        } else {
            echo 'Привет гость сайта' . '<br/>';
        }
    }
}


class Person
{
    use AppUserAuthentication, MobileUserAuthentication {
        AppUserAuthentication::authenticate insteadof MobileUserAuthentication;
        MobileUserAuthentication::authenticate as appAuthenticate;
    }

    public $name;
    public $password;
    public $appOrDesctop;

    public function __construct($name, $password, $appOrDesctop){
        $this->name = $name;
        $this->password = $password;
        $this->appOrDesctop = $appOrDesctop;
    }

    public function getReturnHello() { 
        
        if ($this->appOrDesctop == 'app') {
            $this->appAuthenticate($this->name, $this->password);
        } else {
            $this->authenticate($this->name, $this->password);
        }
    }

}

$person = new Person('Иван', '3535131231', 'app');
$person->getReturnHello();

$person2 = new Person('Максим', '3535131231', 'desktop');
$person2->getReturnHello();
?>
