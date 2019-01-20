<?php
/**
 * Created by PhpStorm.
 * User: Sandra
 * Date: 13/01/2019
 * Time: 19:38
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("", name="welcome_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

}