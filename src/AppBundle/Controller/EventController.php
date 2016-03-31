<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EventController extends Controller
{
    /**
     * @Route("/events", name="event_list")
     */
    public function indexAction(Request $request)
    {
        $events = $this->getDoctrine()
            ->getRepository('AppBundle:Event')
            ->findAll();

        return $this->render('event/index.html.twig',[
            'events' => $events
        ]);
    }
    /**
     * @Route("/event/create", name="event_create")
     */
    public function createAction(Request $request)
    {
        $event = new Event();

        $form = $this->createFormBuilder($event)
            ->add('name', TextType::class,
                array('attr' => array('class' => 'form-control', 'style' =>'margin-bottom: 15px')))
            ->add('category', EntityType::class,
                array('class' => 'AppBundle:Category', 'choice_label' => 'name','attr' => array('class' => 'form-control', 'style' =>'margin-bottom: 15px')))
            ->add('details', TextareaType::class,
                array('attr' => array('class' => 'form-control','style' =>'margin-bottom: 15px')))
            ->add('day', DateTimeType::class,
                array('attr' => array('class' => 'form-control-day','style' =>'margin-bottom: 15px')))
            ->add('street_address', TextType::class,
                array('attr' => array('class' => 'form-control','style' =>'margin-bottom: 15px')))
            ->add('city', TextType::class,
                array('attr' => array('class' => 'form-control','style' =>'margin-bottom: 15px')))
            ->add('zipcode', TextType::class,
                array('attr' => array('class' => 'form-control','style' =>'margin-bottom: 15px')))
            ->add('save', SubmitType::class,
                array('label' => 'Create Event', 'attr' => array('class' => 'btn btn-primary')))
            ->getForm();

        $form->handleRequest($request);

        //Check Submit
        if($form->isSubmitted() && $form->isValid()){
            $name = $form['name']->getData();
            $category = $form['category']->getData();
            $details = $form['details']->getData();
            $street_address = $form['street_address']->getData();
            $city = $form['city']->getData();
            $zipcode = $form['zipcode']->getData();
            $day = $form['day']->getData();

            //get current date and time
            $date = new \DateTime('now');

            $event->setName($name);
            $event->setCategory($category);
            $event->setDay($day);
            $event->setStreetAddress($street_address);
            $event->setCity($city);
            $event->setZipcode($zipcode);
            $event->setDetails($details);
            $event->setCreateDate($date);

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            $this->addFlash('notice','Event Saved');

            return $this->redirectToRoute('event_list');
        }

        //Render Template
        return $this->render('event/create.html.twig',[
            'form' =>  $form->createView()
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
