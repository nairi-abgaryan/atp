<?php

namespace App\Controller;

use App\Entity\Ecogames\Ecogames;
use App\Entity\Interactive\InteractiveBottom;
use App\Entity\Interactive\InteractiveSlider;
use App\Entity\Magazine\Magazine;
use App\Entity\Tchalo\TchaloContent;
use App\Entity\Treevia\Treevia;
use App\Entity\TreeviaQuestion;
use App\Entity\Videos\VideosContent;
use App\Entity\Videos\VideosTop;
use App\Service\MailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type;

class InteractiveController extends AbstractController
{

    public $lang='eng';
    private $mailer;

    /**
     * InteractiveController constructor.
     * @param MailService $mailer
     */
    public function __construct(MailService $mailer)
    {
        $this->mailer = $mailer;
        $session = new Session();

        if($session->isStarted()){
            $session->start();
        }
        $lang = $session->get('lang');

        if(!isset($lang)){
            $session->set('lang', 'eng');
        }
        $this->lang = $session->get('lang');
    }

    /**
     * @Route("/interactive", name="interactive")
     */
    public function interactive()
    {
        $slider = $this->getDoctrine()
            ->getRepository(InteractiveSlider::class)
            ->findAll();

        $bottom = $this->getDoctrine()
            ->getRepository(InteractiveBottom::class)
            ->findAll();

        return $this->render('interactive/interactive.html.twig', [
            'slider' => $slider,
            'bottom' => $bottom,
            'lang' => $this->lang,
        ]);
    }

    /**
     * @Route("/ecogames", name="ecogames")
     */
    public function ecogames()
    {
        $content = $this->getDoctrine()
            ->getRepository(Ecogames::class)
            ->findAll();

        return $this->render('interactive/ecogames.html.twig', [
            'content' => $content,
            'lang' => $this->lang,
        ]);
    }

    /**
     * @Route("/bbmagazine", name="bbmagazine")
     */
    public function bbmagazine()
    {
        $content = $this->getDoctrine()
            ->getRepository(Magazine::class)
            ->findAll();

        return $this->render('interactive/bbmagazine.html.twig', [
            'content' => $content,
            'lang' => $this->lang,
        ]);
    }

    /**
     * @Route("/videos", name="videos")
     */
    public function videos()
    {
        $top = $this->getDoctrine()
            ->getRepository(VideosTop::class)
            ->findOneBy([], ['id'=>'DESC']);

        $content = $this->getDoctrine()
            ->getRepository(VideosContent::class)
            ->findAll();

        return $this->render('interactive/videos.html.twig', [
            'top' => $top,
            'content' => $content,
            'lang' => $this->lang,
        ]);
    }

    /**
     * @Route("/tchalo", name="tchalo")
     */
    public function tchalo()
    {

        $content = $this->getDoctrine()
            ->getRepository(TchaloContent::class)
            ->findOneBy([], ['id'=>'DESC']);

        return $this->render('interactive/tchalo.html.twig', [
            'content' => $content,
            'lang' => $this->lang,
        ]);
    }

    /**
     * @Route("/coloring", name="coloring")
     */
    public function coloring()
    {
        return $this->render('interactive/coloring.html.twig');
    }

    /**
     * @Route("/treevia", name="treevia")
     * @param Request $request
     * @return
     */
    public function treevia(Request $request)
    {
        $content = $this->getDoctrine()
        ->getRepository(Treevia::class)
        ->findAll();

        $form = $this->createFormBuilder(null, array('csrf_protection' => false))
            ->add('firstName', Type\TextType::class)
            ->add('lastName', Type\TextType::class)
            ->add('email', Type\EmailType::class)
            ->add('country', Type\HiddenType::class, ['required' => true])
            ->add('comments', Type\TextareaType::class, ['required' => false])
            ->add('send', Type\SubmitType::class, ['label'=>'Submit'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $question = new TreeviaQuestion();
            $question->setFirstName($data['firstName']);
            $question->setLastName($data['lastName']);
            $question->setEmail($data['email']);
            $question->setCountry($data['country']);
            $question->setComments($data['comments']);

            $entityManager->persist($question);

            $entityManager->flush();

            /** @var  $template */
            $template = $this->render("email/treevia.html.twig", [
                "question" => $question
            ]);

            $this->mailer->sendTreeviaEmail($template, 'info@armeniatree.org');

            return $this->render('interactive/treevia.html.twig', [
                'form' => $form->createView(),
                'content' => $content,
                'lang' => $this->lang,
                'done' => true
            ]);
        }

        return $this->render('interactive/treevia.html.twig', [
            'form' => $form->createView(),
            'content' => $content,
            'lang' => $this->lang,
        ]);
    }
}