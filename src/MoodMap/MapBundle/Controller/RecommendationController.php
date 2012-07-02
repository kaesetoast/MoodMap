<?php

namespace MoodMap\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoodMap\MapBundle\Entity\Recommendation;
use MoodMap\MapBundle\Form\RecommendationType;

/**
 * Recommendation controller.
 *
 */
class RecommendationController extends Controller
{
    /**
     * Lists all Recommendation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('MoodMapMapBundle:Recommendation')->findAll();

        return $this->render('MoodMapMapBundle:Recommendation:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Recommendation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('MoodMapMapBundle:Recommendation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recommendation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MoodMapMapBundle:Recommendation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Recommendation entity.
     *
     */
    public function newAction()
    {
        $entity = new Recommendation();
        $form   = $this->createForm(new RecommendationType(), $entity);

        return $this->render('MoodMapMapBundle:Recommendation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Recommendation entity.
     *
     */
    public function createAction()
    {
        $entity  = new Recommendation();
        $request = $this->getRequest();
        $form    = $this->createForm(new RecommendationType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_recommendation_show', array('id' => $entity->getId())));
            
        }

        return $this->render('MoodMapMapBundle:Recommendation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Recommendation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('MoodMapMapBundle:Recommendation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recommendation entity.');
        }

        $editForm = $this->createForm(new RecommendationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MoodMapMapBundle:Recommendation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Recommendation entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('MoodMapMapBundle:Recommendation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recommendation entity.');
        }

        $editForm   = $this->createForm(new RecommendationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_recommendation_edit', array('id' => $id)));
        }

        return $this->render('MoodMapMapBundle:Recommendation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Recommendation entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('MoodMapMapBundle:Recommendation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Recommendation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_recommendation'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}