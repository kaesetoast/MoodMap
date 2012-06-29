<?php

namespace MoodMap\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoodMap\MapBundle\Entity\MoodWord;
use MoodMap\MapBundle\Form\MoodWordType;

/**
 * MoodWord controller.
 *
 */
class MoodWordController extends Controller
{
    /**
     * Lists all MoodWord entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('MoodMapMapBundle:MoodWord')->findAll();

        return $this->render('MoodMapMapBundle:MoodWord:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a MoodWord entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('MoodMapMapBundle:MoodWord')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MoodWord entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MoodMapMapBundle:MoodWord:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new MoodWord entity.
     *
     */
    public function newAction()
    {
        return $this->render('MoodMapMapBundle:MoodWord:new.html.twig', array(
            'entity' => null,
        ));
    }

    /**
     * Creates a new MoodWord entity.
     *
     */
    public function createAction()
    {
        $entity = new MoodWord();
        $request = $this->getRequest();

        $entity->setWord($request->get("word"));
        $entity->setColors(json_decode($request->get("colors")));

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($entity);
        $em->flush();

        // return $this->redirect($this->generateUrl('admin_moodword_show', array('id' => $entity->getId())));
        return $this->redirect($this->generateUrl('admin_moodword'));
    }

    /**
     * Displays a form to edit an existing MoodWord entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('MoodMapMapBundle:MoodWord')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MoodWord entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MoodMapMapBundle:MoodWord:edit.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing MoodWord entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('MoodMapMapBundle:MoodWord')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MoodWord entity.');
        }

        $editForm = $this->createForm(new MoodWordType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_moodword_edit', array('id' => $id)));
        }

        return $this->render('MoodMapMapBundle:MoodWord:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a MoodWord entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('MoodMapMapBundle:MoodWord')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MoodWord entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_moodword'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}
