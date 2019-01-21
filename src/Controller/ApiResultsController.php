<?php
/**
 * Created by PhpStorm.
 * User: Sandra
 * Date: 21/01/2019
 * Time: 01:42
 */

namespace App\Controller;

use App\Entity\Results;
use App\Entity\Message;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class ApiResultsController
 *
 * @package App\Controller
 *
 * @Route("/api/v1/results");
 */

class ApiResultsController extends AbstractController
{

    /**
     * Returns all results
     *
     * @return JsonResponse
     * @Route("", name="cget_results", methods={ "GET" })
     */
    public function cgetResults(): JsonResponse
    {
        $results = $this->getDoctrine()
            ->getRepository(Results::class)
            ->findAll();

        return $results
            ? new JsonResponse(['results ' => $results])
            : new JsonResponse(
                new Message(Response::HTTP_NOT_FOUND, Response::$statusTexts[404]),
                Response::HTTP_NOT_FOUND
            );


    }

    /**
     * Creates a new result
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     * @Route("", name="post_results", methods={ "POST" })
     */
    public function postResults(Request $request): JsonResponse
    {
        $body = $request->getContent();
        $data = json_decode($body, true);

        if(!$data['userId'] || !$data['result']){
            return new JsonResponse(
                new Message(Response::HTTP_BAD_REQUEST, Response::$statusTexts[400]),
                Response::HTTP_BAD_REQUEST
            );
        }

        $user = $this->getDoctrine()
            ->getRepository(Users::class)
            ->find($data['userId']);

        if (!$user) {
            return new JsonResponse(
                new Message(Response::HTTP_NOT_FOUND, Response::$statusTexts[404]),
                Response::HTTP_NOT_FOUND
            );
        }

        $timestamp = new \DateTime('now');

        /** @var Users $user */
        $newResult = new Results($data['result'], $user, $timestamp);

        $em = $this->getDoctrine()->getManager();
        $em->persist($newResult);
        $em->flush();

        return new JsonResponse(['results ' => $newResult]);
    }

    /**
     * Provides the list of HTTP supported methods
     *
     * @return JsonResponse
     * @Route("", name="options_results", methods={ "OPTIONS" })
     */
    public function optionsResults(): JsonResponse
    {


    }

    /**
     * Returns a result based on a single ID
     *
     * @return JsonResponse
     * @Route("/{resultId}", name="get_result", methods={ "GET" })
     */
    public function getResult(): JsonResponse
    {


    }

    /**
     * Updates a result
     *
     * @return JsonResponse
     * @Route("/{resultId}", name="put_result", methods={ "PUT" })
     */
    public function putResult(): JsonResponse
    {


    }

    /**
     * Deletes a result
     *
     * @return JsonResponse
     * @Route("/{resultId}", name="delete_result", methods={ "DELETE" })
     */
    public function deleteResult(): JsonResponse
    {


    }

    /**
     * Provides the list of HTTP supported methods
     *
     * @return JsonResponse
     * @Route("/{resultId}", name="options_result", methods={ "OPTIONS" })
     */
    public function optionResult(): JsonResponse
    {


    }
}