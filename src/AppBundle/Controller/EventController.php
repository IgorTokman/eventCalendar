<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EventController extends Controller
{
    /**
     * @Route("/events", name="event_list")
     */
    public function indexAction(Request $request)
    {
        return $this->render('event/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    /**
     * @Route("/event/create", name="event_create")
     */
    public function createAction(Request $request)
    {
        return $this->render('event/create.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    /**
     * @Route("/event/edit/{id}", name="event_edit")
     */
    public function editAction(Request $request)
    {
        return $this->render('event/edit.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    /**
     * @Route("/event/delete/{id}", name="event_delete")
     */
    public function deleteAction(Request $request)
    {
        return $this->render('event/delete.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
}
