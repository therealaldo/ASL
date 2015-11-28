<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListController extends Controller
{
    /**
     * @Route("/list", name="list")
     */
    public function listAction(Request $request)
    {
        return $this->render('list/list.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..')
        ));
    }
}
