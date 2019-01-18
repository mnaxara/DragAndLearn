<?php
namespace App\Service;


use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Theme{

    public $theme;

    public function __construct(TokenStorageInterface $tokenStorage){

        $connectedAsk = $tokenStorage->getToken();

        if($connectedAsk != null && $connectedAsk->getUser() != 'anon.'){
            $this->theme = $connectedAsk->getUser()->getTheme()->getColor();
        }

    }

}