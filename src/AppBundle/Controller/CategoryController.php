<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    /**
     * @Route("/categories", name="category_list")
     */
    public function indexAction(Request $request)
    {
        return $this->render('category/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    /**
     * @Route("/category/create", name="category_create")
     */
    public function createAction(Request $request)
    {
        return $this->render('category/create.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
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
