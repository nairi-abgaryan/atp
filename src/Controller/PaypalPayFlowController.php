<?php

namespace App\Controller;

use App\Entity\Donation;
use App\Entity\Certificate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PaypalPayFlow;
use App\Service\MailService;
use Symfony\Component\HttpFoundation\Request;

class PaypalPayFlowController extends AbstractController
{
    private $mailer;

    /**
     * PaypalPayFlowController constructor.
     * @param MailService $mailer
     */
    public function __construct(MailService $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @Route("/singlepayflow/{id}", name="singlepayflow")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function onetime(Request $request)
    {
        $id = $request->attributes->get('id');

        $donation = $this->getDoctrine()
            ->getRepository(Donation::class)
            ->find($id);

        $paypal = new PaypalPayFlow();
        $result = $paypal->runSingle($donation);

        $entityManager = $this->getDoctrine()->getManager();

        $number = substr($donation->getAccountNumber(), 12);
        $donation->setAccountNumber('************'.$number);
        $donation->setTransactionId($result[2]);
        $donation->setAccountType(null);
        $donation->setExpiryMonth(null);
        $donation->setExpiryYear(null);
        $donation->setCvv(null);
        $donation->setUpdatedAt(new \DateTime('now'));
        $donation->setTransactionCode($result[0]);
        $donation->setTransactionStatus($result[1]);

        $entityManager->persist($donation);

        $entityManager->flush();

        if($result[0] == 0){
            return $this->redirectToRoute('donepayflow', array('id' => $id ));
        }else{
            return $this->redirectToRoute('payment', array('id' => $id ));
        }
    }

    /**
     * @Route("/donepayflow", name="donepayflow")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function done(Request $request)
    {
        $id = $request->attributes->get('id');

        $donation = $this->getDoctrine()
            ->getRepository(Donation::class)
            ->find($id);

        if($donation->getMailSent() != 'sent'){
            if($donation->getCertificate() == 'Yes'){
                $certificate = $this->getDoctrine()
                    ->getRepository(Certificate::class)
                    ->findOneBy(['donationId'=>$id]);

                /** @var  $template */
                $template = $this->render("email/donation.html.twig", [
                    "donation" => $donation,
                    'certificate' => $certificate
                ]);
            }else{
                /** @var  $template */
                $template = $this->render("email/donation.html.twig", [
                    "donation" => $donation
                ]);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $donation->setMailSent('sent');

            $entityManager->persist($donation);

            $entityManager->flush();

            $this->mailer->sendDonationEmail($template, $donation->getEmail());
        }

        return $this->render('paypal-pay-flow/thanks.html.twig', [
            'donation' => $donation,
        ]);
    }

    /**
     * @Route("/monthlypayflow/{id}", name="monthlypayflow")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function monthly(Request $request)
    {
        $id = $request->attributes->get('id');

        $donation = $this->getDoctrine()
            ->getRepository(Donation::class)
            ->find($id);

        $paypal = new PaypalPayFlow();
        $result = $paypal->runMonthly($donation);

        $entityManager = $this->getDoctrine()->getManager();

        $number = substr($donation->getAccountNumber(), 12);
        $donation->setAccountNumber('************'.$number);
        $donation->setTransactionId($result[2]);
        $donation->setAccountType(null);
        $donation->setExpiryMonth(null);
        $donation->setExpiryYear(null);
        $donation->setCvv(null);
        $donation->setUpdatedAt(new \DateTime('now'));
        $donation->setTransactionCode($result[0]);
        $donation->setTransactionStatus($result[1]);

        $entityManager->persist($donation);

        $entityManager->flush();

        if($result[0] == 0){
            return $this->redirectToRoute('donepayflow', array('id' => $id ));
        }else{
            return $this->redirectToRoute('payment', array('id' => $id ));
        }
    }
}