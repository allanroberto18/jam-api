<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route(path="/", methods={"GET"})
     * @return Response
     */
    public function getIndex(): Response
    {
        return $this->render('default/index.html.twig');
    }
}
