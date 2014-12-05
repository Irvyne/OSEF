<?php

namespace OSEF\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use OSEF\AppBundle\Entity\Article;
use OSEF\AppBundle\Form\ArticleType;
use OSEF\AppBundle\Manager\ArticleManager;

/**
 * Article controller.
 */
class ArticleController extends Controller
{
    /**
     * Lists all Article entities.
     */
    public function indexAction()
    {
        $entities = $this->getArticleManager()->getRepository()->findAll();

        return $this->render('OSEFAppBundle:Article:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a form to create a Article entity.
     *
     * @param Article $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Article $entity)
    {
        $form = $this->createForm('osef_appbundle_article', $entity, array(
            'action' => $this->generateUrl('article_new'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Article entity.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $entity = new Article();
        $form   = $this->createCreateForm($entity);

        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $this->getArticleManager()->create($entity);

                return $this->redirect($this->generateUrl('article_show', ['slug' => $entity->getSlug()]));
            }
        }

        return $this->render('OSEFAppBundle:Article:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Article entity.
     *
     * @param $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($slug)
    {
        $entity = $this->getArticleManager()->getRepository()->findOneBy(['slug' => $slug]);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($entity->getId());

        return $this->render('OSEFAppBundle:Article:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Article entity.
    *
    * @param Article $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Article $entity)
    {
        $form = $this->createForm('osef_appbundle_article', $entity, array(
            'action' => $this->generateUrl('article_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Article entity.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->getArticleManager()->getRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);

        if (true === in_array($request->getMethod(), ['POST', 'PUT'])) {
            $editForm->handleRequest($request);

            if ($editForm->isValid()) {
                $this->getArticleManager()->update($entity);

                return $this->redirect($this->generateUrl('article_update', array('id' => $id)));
            }
        }

        return $this->render('OSEFAppBundle:Article:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Article entity.
     *
     * @param Request $request
     * @param         $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity = $this->getArticleManager()->getRepository()->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Article entity.');
            }

            $this->getArticleManager()->delete($entity);
        }

        return $this->redirect($this->generateUrl('article'));
    }

    /**
     * Creates a form to delete a Article entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * @return ArticleManager
     */
    private function getArticleManager()
    {
        return $this->get('osef_app.article.manager');
    }
}
