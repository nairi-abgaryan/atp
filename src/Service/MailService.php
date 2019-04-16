<?php

namespace App\Service;

use GuzzleHttp\Client;

class MailService
{
    /**
     * @var string
     */
    private $mailGunURL;

    /**
     * @var string
     */
    private $mailFrom;

    /**
     * MailService constructor.
     * @param string $mailGunURL
     * @param string $mailFrom
     */
    public function __construct(string $mailGunURL, string $mailFrom)
    {
        $this->mailGunURL = $mailGunURL;
        $this->mailFrom = $mailFrom;
    }

    public function sendDonationEmail($html, $toEmail)
    {
        $client = new Client();
        $client->request("POST", $this->mailGunURL, [
            "form_params" => [
                "from" => 'Armenia Tree Project '.$this->mailFrom,
                "to" => $toEmail,
                "cc" => 'order@armeniatree.org',
                "bcc" => 'info@armeniatree.org, hillel@armeniatree.org',
                "subject" => "Thank you for your donation to Armenia Tree Project!",
                "html" => $html->getContent(),
                "text" => "Donation"
            ],
        ]);
    }

    public function sendVolunteerEmail($html, $toEmail)
    {
        $client = new Client();
        $client->request("POST", $this->mailGunURL, [
            "form_params" => [
                "from" => 'Armenia Tree Project '.$this->mailFrom,
                "to" => $toEmail,
                "subject" => "New Volunteer request!",
                "html" => $html->getContent(),
                "text" => "Volunteer"
            ],
        ]);
    }

    public function sendAmbassadorEmail($html, $toEmail)
    {
        $client = new Client();
        $client->request("POST", $this->mailGunURL, [
            "form_params" => [
                "from" => 'Armenia Tree Project '.$this->mailFrom,
                "to" => $toEmail,
                "subject" => "New Ambassador request!",
                "html" => $html->getContent(),
                "text" => "Ambassador"
            ],
        ]);
    }

    public function sendInterestEmail($html, $toEmail)
    {
        $client = new Client();
        $client->request("POST", $this->mailGunURL, [
            "form_params" => [
                "from" => 'Armenia Tree Project '.$this->mailFrom,
                "to" => $toEmail,
                "subject" => "New Building Bridges request!",
                "html" => $html->getContent(),
                "text" => "Building Bridges"
            ],
        ]);
    }

    public function sendTreeviaEmail($html, $toEmail)
    {
        $client = new Client();
        $client->request("POST", $this->mailGunURL, [
            "form_params" => [
                "from" => 'Armenia Tree Project '.$this->mailFrom,
                "to" => $toEmail,
                "subject" => "New Treevia Question!",
                "html" => $html->getContent(),
                "text" => "Treevia"
            ],
        ]);
    }
}