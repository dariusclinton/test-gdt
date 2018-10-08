<?php

namespace AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class PromotionAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = "promotions";

    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'createdDate',
    ];


    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('publish_promotion', $this->getRouterIdParameter().'/publish-promotion');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('type')
            ->add('expirationDate')
            ->add('promotion')
            ->add('description')
            ->add('redirectUrl')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('type', null, array(
                'label' => 'Code/Promo',
            ))
            ->add('shop', null, array(
                'label' => 'Boutique',
                'associated_property' => 'displayName'
            ))
            ->add('expirationDate', null, array(
                'label' => 'Date d\'expiration'
            ))
            ->add('promotion')
            ->add('description')
            ->add('redirectUrl')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                    'Publier' => [
                        'template' => 'AdminBundle:CRUD:list__action_publish_promotion.html.twig'
                    ],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('type')
            ->add('expirationDate')
            ->add('promotion')
            ->add('description')
            ->add('redirectUrl')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('type')
            ->add('expirationDate')
            ->add('promotion')
            ->add('description')
            ->add('redirectUrl')
        ;
    }
}
