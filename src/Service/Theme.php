<?php
namespace App\Service;


use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Theme{

    public $theme;

    public function __construct(TokenStorageInterface $tokenStorage){

//        $this->theme = $tokenStorage->getToken()->getUser()->getTheme()->getColor();

    }

}