<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Promotion;
use AppBundle\Entity\Shop;
use AppBundle\Form\PromotionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $repo = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('AppBundle:Promotion');

        $promotions = $repo->findAllWithoutPublisher();

        $parameters = array(
            'promotions' => $promotions
        );

        return $this->render('AppBundle:Default:index.html.twig', $parameters);
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route(
     *     "/shop/{id}",
     *     name="show_shop",
     *     requirements={"id": "\d+"}
     * )
     */
    public function showShop(Shop $shop, Request $request) {
        $parameters = array(
            'shop' => $shop
        );

        return $this->render('AppBundle:Default:show-shop.html.twig', $parameters);
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/post-promotion", name="post_promotion")
     *
     */
    public function postPromotion(Request $request) {
        $promotion = new Promotion();

        $form = $this->createForm(PromotionType::class, $promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($promotion);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }


        $parameters = array(
            'form' => $form->createView()
        );

        return $this->render('AppBundle:Default:post-promotion.html.twig', $parameters);
    }
}
