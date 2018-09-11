<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/123", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('@App/default/index.html.twig', [
            'title' => 'Это страница со списком заявок'
        ]);
    }

    /**
     * @Route("/new-task", name="newTask")
     */
    public function createTaskAction(Request $request)
    {
        return $this->render('@App/default/newTask.html.twig', [
            'title' => 'Это страница с новой заявкой'
        ]);
    }
}
