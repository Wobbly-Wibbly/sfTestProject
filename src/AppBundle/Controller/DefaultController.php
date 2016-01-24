<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Default:list.html.twig', [
            'posts' => $this->getDoctrine()->getRepository(Post::class)->findAll()
        ]);
    }


    /**
     * @Route("/post/new", name = "post_new")
     * @Method("POST")
     */
    public function addPostAction(Request $request)
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Post $post */
            $post = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('AppBundle:Default:add_post_error.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    /**
     * This controller is called directly via the render() function in the template.
     *
     * @return Response
     */
    public function postFormAction()
    {
        $form = $this->createForm(PostType::class);
        return $this->render('AppBundle:Default:_post_form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
