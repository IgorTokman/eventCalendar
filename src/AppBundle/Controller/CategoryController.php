<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Tests\Extension\Core\Type\SubmitTypeTest;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoryController extends Controller
{
    /**
     * @Route("/categories", name="category_list")
     */
    public function indexAction(Request $request)
    {
        $categories = $this->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->findAll();
        
        return $this->render('category/index.html.twig',[
            'categories' => $categories
        ]);
    }
    /**
     * @Route("/category/create", name="category_create")
     */
    public function createAction(Request $request)
    {
        $category = new Category();

        $form = $this->createFormBuilder($category)
            ->add('name', TextType::class,
                array('attr' => array('class' => 'form-control', 'style' =>'margin-bottom: 15px')))
            ->add('save', SubmitType::class,
                array('label' => 'Create Category', 'attr' => array('class' => 'btn btn-primary')))
            ->getForm();

        $form->handleRequest($request);

        //Check Submit
        if($form->isSubmitted() && $form->isValid()){
            $name = $form['name']->getData();
            $date = new \DateTime('now');

            $category->setName($name);
            $category->setCreateDate($date);

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash('notice','Category Saved');

            return $this->redirectToRoute('category_list');
        }

        //Render Template
        return $this->render('category/create.html.twig',[
            'form' =>  $form->createView()
        ]);
    }
    /**
     * @Route("/category/edit/{id}", name="category_edit")
     */
    public function editAction(Request $request)
    {
        return $this->render('category/edit.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    /**
     * @Route("/category/delete/{id}", name="category_delete")
     */
    public function deleteAction(Request $request)
    {
        return $this->render('category/delete.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

}
