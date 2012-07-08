<?php

namespace MoodMap\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoodMap\MapBundle\Entity\Recommendation;
use MoodMap\MapBundle\Entity\Tag;
use MoodMap\MapBundle\Form\RecommendationType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Recommendation Controller
 *
 * @author Philipp Nowinski <philipp@nowinski.de>
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
        $em = $this->getDoctrine()->getEntityManager();

        $entity  = new Recommendation();
        $request = $this->getRequest();

        $form    = $this->createForm(new RecommendationType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $color = $this->get('emotigramm_service')->createEmotigramm($entity->getDescription());
            $entity->setColor($color);
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

    public function tagToIdAction($tag) {
        $em = $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository('MoodMapMapBundle:Tag')->findByName($tag);
        if (count($entities) == 0) {
            $entity = new Tag();
            $entity->setName($tag);
            $em->persist($entity);
            $em->flush();
            $newEntity = true;
        } else {
            $entity = $entities[0];
            $newEntity = false;
        }
        $response = new Response(json_encode(array('id' => $entity->getId(), 'name' => $entity->getName(), 'isNew' => $newEntity)));
        $response->headers
            ->set("Content-Type", "application/json", "charset=utf-8");
        return $response;
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
