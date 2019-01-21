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
     * @return JsonResponse
     * @Route("", name="post_results", methods={ "POST" })
     */
    public function postResults(): JsonResponse
    {


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