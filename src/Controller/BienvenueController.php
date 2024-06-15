<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;

class BienvenueController
{
    public function sayWelcome()
    {
        return new Response("Bienvenue les L3 INFO ISM!!!");
    }
}