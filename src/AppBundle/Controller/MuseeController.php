<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Musee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/musees")
 */
class MuseeController extends Controller
{

    /**
     * @Route("/", name="musee_index")
     * @Template("AppBundle:Musee:index.html.twig")
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request)
    {
        $page = max(1, $request->query->get('page', 1));

        $repository = $this->getDoctrine()->getRepository('AppBundle:Musee');
        $musees = $repository->getByPage($page);
        $nrOfPages = $repository->getNrOfPages();

        return [
            'musees' => $musees,
            'page' => $page,
            'nr_of_pages' => $nrOfPages,
        ];
    }

    /**
     * @Route("/par-arrondissement", name="musee_index_par_arrondissement")
     * @Template("AppBundle:Musee:index.html.twig")
     * @param Request $request
     * @return array
     */
    public function indexParArondissementAction(Request $request)
    {
        $page = max(1, $request->query->get('page', 1));

        $repository = $this->getDoctrine()->getRepository('AppBundle:Musee');
        $musees = $repository->getByPageOrderedByArondissement($page);
        $nrOfPages = $repository->getNrOfPages();

        return [
            'musees' => $musees,
            'page' => $page,
            'nr_of_pages' => $nrOfPages,
        ];
    }

    /**
     * @Route("/{id}", name="musee_show")
     * @ParamConverter("musee", class="AppBundle:Musee")
     * @Template("AppBundle:Musee:show.html.twig")
     * @param Musee $musee
     * @return array
     */
    public function showAction(Musee $musee)
    {
        $commentForm = $this->createForm('AppBundle\Form\CommentType', new Comment, [
            'action' => $this->generateUrl('musee_comment_create', ['musee_id' => $musee->getId()]),
        ]);

        return ['musee' => $musee, 'commentForm' => $commentForm->createView()];
    }

    /**
     * @Route("/{id}/edit", name="musee_edit")
     * @ParamConverter("musee", class="AppBundle:Musee")
     * @Template("AppBundle:Musee:edit.html.twig")
     * @param Request $request
     * @param Musee $musee
     * @return array
     */
    public function editAction(Request $request, Musee $musee)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Please authenticate yourself first.');


        $form = $this->createForm('AppBundle\Form\MuseeType', $musee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('musee_show', ['id' => $musee->getId()]);
        }

        return ['musee' => $musee, 'form' => $form->createView()];
    }
}
