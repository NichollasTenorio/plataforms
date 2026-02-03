<?php
require_once "../../common.php";
?>

<?php

abstract class UserAccount
{
    public function __construct(
        private string $userName,
        private string $userEmail,
        private string $userPassword,
        private string $userType
    ){}

    private array $userInfos = [];

    public function setUserName($userName):void
    {
        $this->userName = $userName;
    }

    public function getUserName():string
    {
        return $this->userName;
    }

    public function setUserEmail($userEmail):void
    {
        $this->userEmail = $userEmail;
    }

    public function getUserEmail():string
    {
        return $this->userEmail;
    }

    public function setUserPassword($userPassword):void
    {
        $this->userPassword = $userPassword;
    }

    public function getUserPassword():string
    {
        return $this->userPassword;
    }

    public function setUserType($userType):void
    {
        $this->userType = $userType;
    }

    public function getUserType():string
    {
        return $this->userType;
    }

    public function userInfoList():array
    {
        $this->userInfos = [
            'name'     => $this->getUserName(),
            'email'    => $this->getUserEmail(),
            'password' => $this->getUserPassword(),
            'userType' => $this->getUserType()
        ];

        return $this->userInfos;

    }

    public function ConvertList()
    {
        foreach($this->userInfoList() as $infoOfUser){
            echo $infoOfUser . "<br/>";
            
        }

    }
   
}

class PremiumUser extends UserAccount{}

class FreeUser extends UserAccount{}

class UserFactory
{
    public static function create(
        string $name,
        string $email,
        string $password,
        string $type
    ): PremiumUser|FreeUser {
        return match (strtolower($type)) {
            'premium' => new PremiumUser($name, $email, $password, 'premium'),
            'free'    => new FreeUser($name, $email, $password, 'free'),
            default   => throw new Exception("Tipo de usuário inválido: $type"),
        };
    }
}

$freeUser = UserFactory::create(
    'Nichollas',
    'nichollas.tenorio.sj@gmail.com',
    'nico123',
    'premium'
);

echo $freeUser?->ConvertList();




