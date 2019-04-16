<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Translation\TranslatorInterface;

class LocaleListener
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var TranslatorInterface $translator
     */
    private $translator;

    /**
     * @var \Symfony\Component\HttpFoundation\Session\Session $session
     */
    protected $session;

    /**
     * LocaleListener constructor.
     * @param TranslatorInterface $translator
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     */
    public function __construct
    (
        TranslatorInterface $translator,
        EntityManagerInterface $entityManager,
        SessionInterface $session
    )
    {
        $this->translator = $translator;
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $locale = $this->session->get("lang", "en");
        $lang = substr($locale, 0, 2);
        $this->translator->setLocale($lang);
        $event->getRequest()->setLocale($lang);
        $filter = $this->entityManager
            ->getFilters()
            ->enable('locale_filter');
        $filter->setParameter('lang', $event->getRequest()->getLocale());

    }
}
