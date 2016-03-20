<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Musee;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    /**
     * @Route("/musees/{musee_id}/comments", name="musee_comment_create")
     * @Method("POST")
     * @ParamConverter("musee", class="AppBundle:Musee", options={"id" = "musee_id"})
     * @param Request $request
     * @param Musee $musee
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request, Musee $musee)
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Please authenticate yourself first.');

        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();
        

        $form = $this->createForm('AppBundle\Form\CommentType', new Comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var Comment $comment */
            $comment = $form->getData();

            $comment
                ->setAuthor($user)
                ->setMusee($musee)
                ->setInsertedAt(new \DateTime)
            ;

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('musee_show', ['id' => $musee->getId()]);
        }

        return $this->render('@App/Musee/show.html.twig', [
            'musee' => $musee,
            'commentForm' => $form->createView(),
        ]);
    }

}
