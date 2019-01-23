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

        return new JsonResponse(
            new Message(Response::HTTP_CREATED, Response::$statusTexts[201]),
            Response::HTTP_CREATED
        );
    }

    /**
     * Provides the list of HTTP supported methods
     *
     * @return JsonResponse
     * @Route("", name="options_results", methods={ "OPTIONS" })
     */
    public function optionsResults(): JsonResponse
    {
        return new JsonResponse(
            null, Response::HTTP_OK, array("Allow" => "GET, POST, OPTIONS")
        );
    }

    /**
     * Returns a result based on a single ID
     *
     * @param int $resultId
     * @return JsonResponse
     * @Route("/{resultId}", name="get_result", methods={ "GET" }, requirements={"resultId"="\d+"})
     */
    public function getResultById(int $resultId): JsonResponse
    {
        $result = $this->getDoctrine()
            ->getRepository(Results::class)
            ->find($resultId);

        return $result
            ? new JsonResponse($result)
            : new JsonResponse(
                new Message(Response::HTTP_NOT_FOUND, Response::$statusTexts[404]),
                Response::HTTP_NOT_FOUND
            );
    }

    /**
     * Updates a result
     *
     * @param Request $request
     * @param int $resultId
     * @return JsonResponse
     * @Route("/{resultId}", name="put_result", methods={ "PUT" })
     * @throws \Exception
     */
    public function putResult(int $resultId, Request $request): JsonResponse
    {
        $result = $this->getDoctrine()
            ->getRepository(Results::class)
            ->find($resultId);

        if (!$result) {
            return new JsonResponse(
                new Message(Response::HTTP_NOT_FOUND, Response::$statusTexts[404]),
                Response::HTTP_NOT_FOUND
            );
        }

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

        $result->setResult($data['result']);
        /** @var Users $user */
        $result->setUser($user);
        $result->setTime(new \DateTime('now'));

        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(
            new Message(Response::HTTP_ACCEPTED, Response::$statusTexts[202]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * Deletes a result
     *
     * @param int $resultId
     * @return JsonResponse
     * @Route("/{resultId}", name="delete_result", methods={ "DELETE" })
     */
    public function deleteResult(int $resultId): JsonResponse
    {
        $result = $this->getDoctrine()
            ->getRepository(Results::class)
            ->find($resultId);

        if(!$result){
            return new JsonResponse(
                new Message(Response::HTTP_NOT_FOUND, Response::$statusTexts[404]),
                Response::HTTP_NOT_FOUND
            );
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($result);
        $em->flush();

        return new JsonResponse(
            new Message(Response::HTTP_NO_CONTENT, Response::$statusTexts[204]),
            Response::HTTP_NO_CONTENT
        );
    }

    /**
     * Provides the list of HTTP supported methods
     *
     * @param int $resultId
     * @return JsonResponse
     * @Route("/{resultId}", name="options_result", methods={ "OPTIONS" })
     */
    public function optionResult(int $resultId): JsonResponse
    {
        return $resultId
            ? new JsonResponse(null, Response::HTTP_OK, array("Allow" => "GET, PUT, DELETE, OPTIONS"))
            : new JsonResponse(
                new Message(Response::HTTP_NOT_FOUND, Response::$statusTexts[404]),
                Response::HTTP_NOT_FOUND
            );
    }

    /**
     * Returns all results average
     *
     * @return JsonResponse
     * @Route("/average", name="cget_results_average", methods={ "GET" })
     */
    public function cgetResultsAverage(): JsonResponse
    {
        $results = $this->getDoctrine()
            ->getRepository(Results::class)
            ->findAll();


        if(!$results){
            return new JsonResponse(
                new Message(Response::HTTP_NOT_FOUND, Response::$statusTexts[404]),
                Response::HTTP_NOT_FOUND
            );
        }

        $counter = 0;
        $totalResult = 0;

        foreach ($results as $result) {
            /** @var Results $result */
            $totalResult = $totalResult + $result->getResult();
            $counter++;
        }

        $average = $totalResult / $counter;

        return new JsonResponse(
            [
                'average' => $average,
                'num_results' => $counter
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Returns a user results average
     *
     * @param int $userId
     * @return JsonResponse
     * @Route("/average/{userId}", name="get_user_average", methods={ "GET" })
     */
    public function getUserResultAverage(int $userId): JsonResponse
    {
        $user = $this->getDoctrine()
            ->getRepository(Users::class)
            ->find($userId);

        if(!$user){
            return new JsonResponse(
                new Message(Response::HTTP_NOT_FOUND, Response::$statusTexts[404]),
                Response::HTTP_NOT_FOUND
            );
        }

        $results = $this->getDoctrine()
            ->getRepository(Results::class)
            ->findAll();

        if(!$results){
            return new JsonResponse(
                new Message(Response::HTTP_NOT_FOUND, Response::$statusTexts[404]),
                Response::HTTP_NOT_FOUND
            );
        }

        $counter = 0;
        $totalResult = 0;
        $average = 0;

        /** @var Results $result */
        foreach ($results as $result) {
            $candidate = $result->getUser();

            if ( $candidate->getId() == $userId ){
                $totalResult = $totalResult + $result->getResult();
                $counter++;
            }
        }

        if($counter !== 0) {
            $average = $totalResult / $counter;
        }

        return new JsonResponse(
            [
                'average' => $average,
                'num_results' => $counter
            ],
            Response::HTTP_OK
        );
    }
}