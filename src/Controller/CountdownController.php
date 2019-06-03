<?php
// src/Controller/CountdownController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class CountdownController
{
    public function countdown()
    {
        return new Response(
            '<html><body>Blank Page</body></html>'
        );
    }
}