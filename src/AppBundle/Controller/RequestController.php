<?php
/**
 * Created by PhpStorm.
 * User: AlexK
 * Date: 04.09.2018
 * Time: 23:12
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Request;
use AppBundle\Form\RequestType;
use AppBundle\Form\StatesType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RequestController
 * @package AppBundle\Controller
 */
class RequestController extends Controller
{
    /**
     * @Route("/", name="request_list")
     * @Template()
     */
    public function indexAction()
    {
        $requests = $this->getDoctrine()->getRepository('AppBundle:Request')->findAll();

        $nowDate = new \DateTime();
        return ['requests' => $requests, 'nowDate' => $nowDate];
    }

    /**
     * @Route("/new-request", name="new_request")
     * @Template()
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Response
     */
    public function newRequestAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $form = $this->createForm(RequestType::class/*, ['states' => $this->getDoctrine()->getRepository('AppBundle:States')->find(1)]*/);
        $form->add( 'submit',SubmitType::class);
//        $form->add('states', null);
        $state = $this->getDoctrine()->getRepository('AppBundle:States')->find(1);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $requestTask = $form->getData();
            $requestTask->setState($state);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($requestTask);
            $entityManager->flush();

            return $this->redirectToRoute('request_list');
        }
        return $this->render('@App/request/newRequest.html.twig', [
            'newRequest_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/requests/{id}", name="request_item", requirements={"id": "[0-9]+"})
     * @param Request $requestTask
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Response
     */
    public function showRequestAction(Request $requestTask, \Symfony\Component\HttpFoundation\Request $request)
    {
        $form = $this->createForm(StatesType::class)
            ->add( 'submit',SubmitType::class);

        $form->handleRequest($request);
        dump($form);
        dump($requestTask);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData()->getState());
            $requestTask->setState($form->getData()->getState());

            dump($requestTask);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($requestTask);
            $entityManager->flush();

            return $this->redirectToRoute('request_list');
        }
        return $this->render('@App/request/showRequest.html.twig', [
            'request' => $requestTask,
            'form' => $form->createView()
        ]);

    }
}