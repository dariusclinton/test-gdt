<?php


namespace AdminBundle\Listener;

use AdminBundle\Entity\Administrator;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\Container;
//use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

/**
 * @author Darius Clinton Tsafack <clintontsafack@gmail.com>
 */
class AdminUserListener implements EventSubscriber
{
    //private $encoder;
    private $factory;

    function __construct(Container $container /*UserPasswordEncoder $encoder*/)
    {
        //$this->encoder = $encoder;
        $this->factory = $container->get('security.encoder_factory');
    }


    public function getSubscribedEvents()
    {
        return array(
            'preUpdate',
            'prePersist',
        );
    }

    /**
     * [preUpdate description]
     * @param  LifecycleEventArgs $args [description]
     * @return [type]                   [description]
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->doEncodePassword($args);
    }

    /**
     * [preUpdate description]
     * @param  LifecycleEventArgs $args [description]
     * @return [type]                   [description]
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $this->doEncodePassword($args);
    }

    /**
     * [doEncodePassword description]
     * @param  LifecycleEventArgs $args [description]
     * @return [type]                   [description]
     */
    private function doEncodePassword(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Administrator)
        {
            return ;
        }

        /* $plainPassword = $entity->getPlainPassword();
        if ($plainPassword !== null) {
            $encodedPassword = $this->encoder->encodePassword($entity, $plainPassword);

            $entity->setPassword($encodedPassword);
        }  */

        $encoder = $this->factory->getEncoder($entity);
        $entity->encodePassword($encoder);

        return true;
    }

}