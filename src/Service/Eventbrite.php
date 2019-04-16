<?php

namespace App\Service;

class Eventbrite
{
    private $token;

    public function __construct()
    {
        $this->token = '4CC3LNJNOZHCYCLT4ZAW';
    }

    public function getEvents()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.eventbriteapi.com/v3/users/me/owned_events/?token=".$this->token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $response = (json_decode($response, true));
        curl_close($curl);
        return $response;
    }

    public function getVenue($id)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.eventbriteapi.com/v3/venues/".$id."/?token=".$this->token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $response = (json_decode($response, true));
        curl_close($curl);
        return $response;
    }

    public function createEvent($event)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.eventbriteapi.com/v3/organizations/195076128616/events/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
          \"event\": {
            \"name\": {
              \"html\": \"<p>".$event->getTitle()."</p>\"
            },
            \"description\": {
              \"html\": \"<p>".$event->getDescription()."</p>\"
            },
            \"start\": {
              \"timezone\": \"America/Los_Angeles\",
              \"utc\": \"".$event->getStartDate()->format('Y-m-d')."T02:00:00Z"."\"
            },
            \"end\": {
              \"timezone\": \"America/Los_Angeles\",
              \"utc\": \"".$event->getEndDate()->format('Y-m-d')."T02:00:00Z"."\"
            },
            \"currency\": \"USD\"
          }
        }");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . $this->token,
            "Content-Type: application/json"
        ));

        $response = curl_exec($ch);
        $response = (json_decode($response, true));
        curl_close($ch);

        $this->createTicket($response['id']);
        $this->publishEvent($response['id']);
    }

    public function publishEvent($id)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.eventbriteapi.com/v3/events/".$id."/publish/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . $this->token,
            "Content-Type: application/json"
        ));

        $response = curl_exec($ch);
        $response = (json_decode($response, true));
        curl_close($ch);
        return $response;
    }

    public function createTicket($id)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.eventbriteapi.com/v3/events/".$id."/ticket_classes/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
          \"ticket_class\": {
            \"name\": \"GA\",
            \"description\": \"General Admission\",
            \"donation\": false,
            \"free\": true,
            \"minimum_quantity\": 1,
            \"maximum_quantity\": 10,
            \"quantity_total\": 1000,
            \"sales_start\": \"\",
            \"sales_end\": \"\",
            \"hidden\": false,
            \"include_fee\": false,
            \"split_fee\": false,
            \"hide_description\": false,
            \"auto_hide\": false,
            \"auto_hide_before\": \"\",
            \"auto_hide_after\": \"\",
            \"order_confirmation_message\": \"Success!\",
            \"sales_channels\": [
              \"online\",
              \"atd\"
            ]
          }
        }");


        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . $this->token,
            "Content-Type: application/json"
        ));

        $response = curl_exec($ch);
        $response = (json_decode($response, true));
        curl_close($ch);
        return $response;
    }
}