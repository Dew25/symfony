<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity;

class DefaultController extends Controller
{
     /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        $data=$this->getDoctrine()
        ->getRepository('AppBundle:Post')
        ->findAll();

        return $this->render('default/index.html.twig', array('data' => $data)
        );
    }
    /**
     * @Route("/show/{id}", name="show")
     */
    public function showAction($id)
    {
        $data=$this->getDoctrine()
        ->getRepository('AppBundle:Post')
        ->find($id);

        return $this->render('default/show.html.twig', array('data' => $data)
        );
    }
    /**
     * @Route("/add", name="add")
     */
    public function addAction(Request $request)
    {
       if ($request->getMethod() == 'POST') {
            // $form->bindRequest($request);

            // // data is an array with "name", "email", and "message" keys
            // $post = $form->getData();
            // $em = $this->getDoctrine()->getEntityManager();
            // $query = $em->createQuery(
            //     'SELECT p FROM AppBundle:Users p WHERE p.lastname'
            // )->setParameter('price', '19.99');

            // $products = $query->getResult();
            $em = $this->getDoctrine()->getEntityManager();
            $post=new \AppBundle\Entity\Post();
            
            
            $post->setTitle($request->get('_title'));
            $post->setContent($request->get('_content'));  
            //$post->setDate(date('Y-m-d H:i:s'));
            $post->setDate(new \DateTime());
            $user=new \AppBundle\Entity\Users();
            $author=$request->get('_author');
            // //$user=$em->findOneByName('\AppBundle\Entity\Users',$author);
            $user=$this->getDoctrine()->getRepository("AppBundle:Users")
                ->findOneBylastname($author);
            $post->setUser($user);

            // $varstr=new \AppBundle\Classes\StrVars($post);
            // $varPost=$varstr->getStr();
            // return new Response($varPost);

//var_dump($post);
           
            $em->persist($post);
            $em->flush();
        }
            $data=$this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->findAll();

        return $this->render('default/index.html.twig', array('data' => $data));
    }
    // /**
    //  * @Route("/", name="homepage")
    //  */
    // public function listAction(Request $request)
    // {
    //     $data=$this->getDoctrine()
    //     ->getRepository('AppBundle:Post')
    //     ->findAll();

    //     return new Response(
    //         json_encode($data),
    //         200,
    //         array('Content-Type' => 'application/json')
    //     );
    // }
}
