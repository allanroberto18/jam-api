<?php
declare(strict_types=1);

namespace App\Controller\api;

use Swagger\Annotations as SWG;
use App\Service\UserServiceInterface;
use App\Helpers\SerializerObjectHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class UserController extends AbstractFOSRestController
{
    /** @var UserServiceInterface $service */
    private $service;

    /**
     * UserController constructor.
     * @param UserServiceInterface $service
     */
    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @Route(path="/api/users/", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns all users",
     * )
     * @SWG\Tag(name="users")
     * @return Response
     */
    public function getAllUsers(): Response
    {
        try {
            $users = $this->service->listUsersFromDatabase();
        } catch (\Exception $exception) {
            $msg = [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];

            return new Response(json_encode($msg), Response::HTTP_BAD_REQUEST);
        }

        $data = SerializerObjectHelper::serializeArray($users, 'json');

        return new Response($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/users/{id}", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns an user",
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="query",
     *     type="integer",
     *     description="Id of user"
     * )
     * @SWG\Tag(name="users")
     * @param mixed $id
     * @return Response
     */
    public function loadUser(int $id): Response
    {
        try {
            $user = $this->service->selectUserById((int) $id);
        } catch (\Exception $exception) {
            $msg = [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];

            return new Response(json_encode($msg), Response::HTTP_BAD_REQUEST);
        }

        $data = SerializerObjectHelper::serializeObject($user, 'json');

        return new Response($data, Response::HTTP_OK);
    }

    /**
     * @Route(path="/api/users/excepted-{id}", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns all users excepted specific user",
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="query",
     *     type="integer",
     *     description="Id of user"
     * )
     * @SWG\Tag(name="users")
     * @param mixed $id
     * @return Response
     */
    public function getAllUsersExceptedId($id): Response
    {
        try {
            $users = $this->service->listUsersExceptIdByDatabase((int) $id);
        } catch (\Exception $exception) {
            $msg = [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];

            return new Response(json_encode($msg), Response::HTTP_BAD_REQUEST);
        }

        $data = SerializerObjectHelper::serializeArray($users, 'json');

        return new Response($data, Response::HTTP_OK);
    }
}
