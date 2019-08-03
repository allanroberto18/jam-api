<?php
declare(strict_types=1);

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractFOSRestController
{
    /**
     * @Route(path="/", methods={"GET"})
     * @return Response
     */
    public function getHelloWorld(): Response
    {
        $data = [
            'data' => [
                'msg' => 'hello world'
            ]
        ];

        return new Response(json_encode($data), 200);
    }
}
