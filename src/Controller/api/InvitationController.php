<?php
declare(strict_types=1);

namespace App\Controller\api;

use App\Service\InvitationServiceInterface;
use Swagger\Annotations as SWG;
use App\Service\UserServiceInterface;
use App\Helpers\SerializerObjectHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class InvitationController extends AbstractFOSRestController
{
    /** @var InvitationServiceInterface $service */
    private $service;

    /**
     * UserController constructor.
     * @param InvitationServiceInterface $service
     */
    public function __construct(InvitationServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @Route(path="/api/invitations/sender/{userSenderId}", methods={"GET"})
     * @param mixed $userSenderId
     * @SWG\Response(
     *     response=200,
     *     description="Returns all invitation sent",
     * )
     * @SWG\Tag(name="invitations")
     * @return Response
     */
    public function getAllInvitationsBySender($userSenderId): Response
    {
        try {
            $invitations = $this->service->listInvitationsBySender((int) $userSenderId);
        } catch (\Exception $exception) {
            $msg = [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];

            return new Response(json_encode($msg), Response::HTTP_BAD_REQUEST);
        }

        $data = SerializerObjectHelper::serializeArray($invitations, 'json');

        return new Response($data, Response::HTTP_OK);
    }

    /**
     * @Route(path="/api/invitations/invited/{userInvitedId}", methods={"GET"})
     * @param mixed $userInvitedId
     * @SWG\Response(
     *     response=200,
     *     description="Returns all invitation received",
     * )
     * @SWG\Tag(name="invitations")
     * @return Response
     */
    public function getAllInvitationsByInvited($userInvitedId): Response
    {
        try {
            $invitations = $this->service->listInvitationsByInvited((int) $userInvitedId);
        } catch (\Exception $exception) {
            $msg = [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];

            return new Response(json_encode($msg), Response::HTTP_BAD_REQUEST);
        }

        $data = SerializerObjectHelper::serializeArray($invitations, 'json');

        return new Response($data, Response::HTTP_OK);
    }

    /**
     * @Route(path="/api/invitations/{id}", methods={"PUT"})
     * @param mixed $id
     * @SWG\Response(
     *     response=200,
     *     description="Update invitation state",
     * )
     * @SWG\Tag(name="invitations")
     * @return Response
     */
    public function updateInvitationState($id, Request $request): Response
    {
        try {
            $state = (int) $request->get('state');
            $this->service->updateInvitationStatus((int) $id, $state);
        } catch (\Exception $exception) {
            $msg = [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];

            return new Response(json_encode($msg), Response::HTTP_BAD_REQUEST);
        }

        return new Response('', Response::HTTP_ACCEPTED);
    }
}
