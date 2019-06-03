<?php
// src/Controller/CountdownController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CountdownController extends AbstractController
{
    public function countdown()
    {
    	$name = 'you';

        return $this->render('default/countdown.html.twig', [
            'name' => $name,
        ]);
    }
}