<?php
/**
 * Created by PhpStorm.
 * User: Sandra
 * Date: 13/01/2019
 * Time: 17:19
 */

namespace App\Controller;


use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Message;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiUsersController
 *
 * @package App\Controller
 *
 * @Route("/api/v1/users");
 */
class ApiUsersController extends AbstractController
{
    /**
     * Returns all users
     *
     * @return JsonResponse
     * @Route("", name="cget_users", methods={ "GET" })
     */
    public function cgetUsers(): JsonResponse
    {
        $users = $this->getDoctrine()
            ->getRepository(Users::class)
            ->findAll();

        return $users
            ? new JsonResponse(['users ' => $users])
            : new JsonResponse(
                new Message(Response::HTTP_NOT_FOUND, Response::$statusTexts[404]),
                Response::HTTP_NOT_FOUND
            );

    }

    /**
     * Creates a new user
     *
     * @return JsonResponse
     * @Route("", name="post_users", methods={ "POST" })
     */
    public function postUsers(): JsonResponse
    {


    }

    /**
     * Provides the list of HTTP supported methods
     *
     * @return JsonResponse
     * @Route("", name="options_users", methods={ "OPTIONS" })
     */
    public function optionsUsers(): JsonResponse
    {


    }

    /**
     * Returns a user based on a single ID
     *
     * @param int $userId
     * @return JsonResponse
     * @Route("/{userId}", name="get_user", methods={ "GET" })
     */
    public function getUserById(int $userId): JsonResponse
    {
        $user = $this->getDoctrine()
            ->getRepository(Users::class)
            ->find($userId);

        return $user
            ? new JsonResponse(['user ' => $user])
            : new JsonResponse(
                new Message(Response::HTTP_NOT_FOUND, Response::$statusTexts[404]),
                Response::HTTP_NOT_FOUND
            );

    }

    /**
     * Updates a user
     *
     * @return JsonResponse
     * @Route("/{userId}", name="put_user", methods={ "PUT" })
     */
    public function putUser(): JsonResponse
    {


    }

    /**
     * Deletes a user
     *
     * @return JsonResponse
     * @Route("/{userId}", name="delete_user", methods={ "DELETE" })
     */
    public function deleteUser(): JsonResponse
    {


    }

    /**
     * Provides the list of HTTP supported methods
     *
     * @return JsonResponse
     * @Route("/{userId}", name="options_user", methods={ "OPTIONS" })
     */
    public function optionUser(): JsonResponse
    {


    }


}