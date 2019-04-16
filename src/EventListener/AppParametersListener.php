<?php

namespace App\EventListener;

use App\Model\QueryParameters;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Contracts\Translation\TranslatorInterface;

class AppParametersListener
{
    /**
     * @var TranslatorInterface $translator
     */
    private $translator;

    /**
     * @var SessionInterface $session
     */
    private $session;

    /**
     * AppParametersListener constructor.
     * @param TranslatorInterface $translator
     * @param SessionInterface $session
     */
    public function __construct(TranslatorInterface $translator, SessionInterface $session)
    {
        $this->translator = $translator;
        $this->session = $session;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $lang = $event->getRequest()->attributes->get("lang")??
                $event->getRequest()->query->get("lang")??
                $this->session->get("lang")??"en";
        /** Set language parameter*/
        $event->getRequest()->setLocale($lang);
        $this->session->set("lang", $lang);

        /** Set page and perPage parameters for pagination */
        QueryParameters::$page = $event->getRequest()->headers->get('page', 1);
        QueryParameters::$perPage = $event->getRequest()->headers->get('perPage', 10);
        QueryParameters::$lang = $lang;
    }
}
