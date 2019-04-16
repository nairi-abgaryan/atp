<?php

namespace App\EventListener;

use App\Service\Eventbrite;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EntityListener implements EventSubscriber
{
    /**
     * @var SessionInterface $session
     */
    private $session;

    /**
     * @var EntityManagerInterface $em
     */
    private $em;

    /**
     * EntityListener constructor.
     * @param SessionInterface $session
     * @param EntityManagerInterface $em
     */
    public function __construct(SessionInterface $session, EntityManagerInterface $em)
    {
        $this->session = $session;
        $this->em = $em;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (method_exists($entity, 'setLang')) {
            $entity->setLang($this->session->get("lang"));
        }
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        try {
            $reflect = new \ReflectionClass($entity);
        } catch (\ReflectionException $e) {
        }
        if ($reflect->getShortName() === 'Events') {

            $eventbrite = new Eventbrite();
            $eventbrite->createEvent($entity);
        }

        if (method_exists($entity, 'setLang')) {
            $entity->setLang($this->session->get("lang"));
        }
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        if (method_exists($entity, 'setLang')) {
            $entity->setLang($this->session->get("lang"));
        }
    }

    public function onFlush(OnFlushEventArgs $args)
    {
        $em = $args->getEntityManager();
        $uow = $args->getEntityManager()->getUnitOfWork();
        if ($uow->getScheduledEntityUpdates() != []){
            $entities = $uow->getScheduledEntityUpdates();
        }else{
            $entities = $uow->getScheduledEntityInsertions();
        }

        /** @var mixed $entity */
        foreach ($entities as $entity){
            $metadata = $this->em->getClassMetadata(get_class($entity));
            if (key_exists("entityLang", $metadata->getAssociationMappings())){
                $entityTranslation = $metadata->getAssociationMapping("entityLang")["targetEntity"];
                $metadata = $this->em->getClassMetadata($entityTranslation);
                $metadata->getColumnNames();
                $entityLang = $entity->getEntityLang()[0]??new $entityTranslation();

                foreach ($metadata->getColumnNames() as $field){
                    $ucFiled = ucfirst($field);
                    $functionSet = "set".$ucFiled;
                    $functionGet = "get".$ucFiled;
                    if (property_exists($entity, $field) && $field != 'id'){
                        $entityLang->$functionSet($entity->$functionGet());
                    }
                }

                $entity->addEntityLang($entityLang);
                $em->persist($entity);
                $classMeta = $em->getClassMetadata(get_class($entity));

                $uow->computeChangeSets();
                $uow->computeChangeSet($classMeta, $entity);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return ['prePersist', 'preUpdate', 'postPersist', 'onFlush'];
    }
}

