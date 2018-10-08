<?php

namespace AdminBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PromotionAdminController extends CRUDController
{

    public function publishPromotionAction($id) {
        $promotion = $this->admin->getSubject();

        if (!$promotion) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id: %s', $id));
        }

        if ($promotion->getPublisher() != null) {
            $this->addFlash('sonata_flash_error', 'La promotion a déjà été publiée !');

            return $this->redirectToRoute('admin_app_promotion_list');
        }

        $promotion->setPublisher($this->getUser());

        $em = $this->getDoctrine()->getManager();

        $em->persist($promotion);
        $em->flush();

        return $this->redirectToRoute('admin_app_promotion_list');
    }
}
