<?php

namespace App\Service;

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Agreement;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;

class PaypalCheckout
{

    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
//                  'Aa9dJob1Wi2N3TtYTH1oW_mMpPw2damRJjp4SWbvWIlJqIU05fX4ogmFu4gbY4Ol2mxWEN3mPzKtWHiD',     // ClientID
//               'EIjK-uPizB1x_FVbEpViMO8Hn2BEBFiPrD7j1e3RjKvLGg5RmYjr5QZeDRnNacr4jco1uX8Be5BaFlJj'      // ClientSecret
            'AafehIg7boPwiuJBWpUm2hp2OGFHY6-hM6J1XYjWavDAnt_3Tqa1EJ88qWhB68flC0A6m-pMKRd-49AD',     // ClientID
               'EDokxnkqj-pSFY8jxYKNiacW7FmLQlIllIwCmj2WrgtStzlfBjoEt_Veyh0hhi5J6ljli0uiCvk5n02-'      // ClientSecret
            )
        );

        $this->apiContext->setConfig(
            array(
                'mode' => 'live'
            )
        );
    }

    public function runSingle($donation)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal-checkout');

        $amount = new Amount();
        $amount->setTotal($donation->getAmount().'.00');
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://104.248.253.238/execute")
            ->setCancelUrl("http://104.248.253.238/error");

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            header("Location: ".$payment->getApprovalLink());
            die();
        }
        catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.

            return [false, $ex->getData()];
        }
    }

    public function execute($data)
    {

        try {
            $payment = Payment::get($data['paymentId'], $this->apiContext);
        } catch (Exception $ex) {

            var_dump("Get Payment", "Payment", null, null, $ex);
            exit(1);
        }

//        if (isset($data['success']) && $payment->getState() == 'created') {
        if ($payment->getState() == 'created') {

            $paymentId = $data['paymentId'];
            $payment = Payment::get($paymentId, $this->apiContext);

            $execution = new PaymentExecution();
            $execution->setPayerId($data['PayerID']);

            $transaction = new Transaction();
            $amount = new Amount();

            $amount->setCurrency('USD');
            $amount->setTotal($payment->getTransactions()[0]->getAmount()->getTotal());
            $transaction->setAmount($amount);

            $execution->addTransaction($transaction);

            try {

                $payment->execute($execution, $this->apiContext);

                try {
                    $payment = Payment::get($paymentId, $this->apiContext);
                } catch (Exception $ex) {
                    return [false, ["Error when try to get payment".$payment->getId()]];
                }
            } catch (Exception $ex) {
                return [false, ["Error when try to execute payment" . $payment->getId()]];
            }
            return $payment;
        } else {
            return [false, ["User Cancelled the Approval"]];
        }
    }

    public function createPlan($donation)
    {
        $plan = new Plan();

        $plan->setName('Month Donation Plan')
            ->setDescription($donation->getFirstName().' '.$donation->getLastName())
            ->setType('fixed');

        $paymentDefinition = new PaymentDefinition();

        $paymentDefinition->setName('Regular Payments')
            ->setType('REGULAR')
            ->setFrequency('Month')
            ->setFrequencyInterval("1")
            ->setCycles("12")
            ->setAmount(new Currency(array('value' => $donation->getAmount(), 'currency' => 'USD')));

        $merchantPreferences = new MerchantPreferences();

        $merchantPreferences->setReturnUrl("http://104.248.253.238/agreement?success=true")
            ->setCancelUrl("http://104.248.253.238/agreement?success=false")
            ->setAutoBillAmount("yes")
            ->setInitialFailAmountAction("CONTINUE")
            ->setMaxFailAttempts("0")
            ->setSetupFee(new Currency(array('value' => 1, 'currency' => 'USD')));

        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);

        $request = clone $plan;

        try {
            $output = $plan->create($this->apiContext);
        } catch (Exception $ex) {

            var_dump("Created Plan", "Plan", null, $request, $ex);
            exit(1);
        }

        #var_dump("Created First Plan", "Plan", $output->getId(), $request, $output);

        return $output;

    }

    public function activatePlan($createdPlan)
    {

        try {
            $patch = new Patch();

            $value = new PayPalModel('{
               "state":"ACTIVE"
             }');

            $patch->setOp('replace')
                ->setPath('/')
                ->setValue($value);
            $patchRequest = new PatchRequest();
            $patchRequest->addPatch($patch);

            $createdPlan->update($patchRequest, $this->apiContext);

            $plan = Plan::get($createdPlan->getId(), $this->apiContext);
        } catch (Exception $ex) {

            var_dump("Updated the Plan to Active State", "Plan", null, $patchRequest, $ex);
            exit(1);
        }
        return $plan;


    }

    public function runAgreement($createdPlan)
    {
        $agreement = new Agreement();

        $agreement->setName('Base Agreement')
            ->setDescription('Basic Agreement')
            ->setStartDate('2019-06-17T9:45:04Z');

        $plan = new Plan();
        $plan->setId($createdPlan->getId());
        $agreement->setPlan($plan);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal-checkout');
        $agreement->setPayer($payer);

        try {

            $agreement = $agreement->create($this->apiContext);

            $approvalUrl = $agreement->getApprovalLink();
            header("Location: ".$approvalUrl);
            die();

        } catch (Exception $ex) {

            return false;
        }
    }

    public function executeAgreement($data)
    {
        if (isset($data['success']) && $data['success'] == 'true') {
            $token = $data['token'];
            $agreement = new Agreement();
            try {

                $agreement->execute($token, $this->apiContext);
            } catch (Exception $ex) {

                return [false, ["Error when try to execute an Agreement".$agreement->getId()]];
            }

            try {
                $agreement = Agreement::get($agreement->getId(), $this->apiContext);
            } catch (Exception $ex) {
                return [false, ["Error when try to get an Agreement" . $agreement->getId()]];
            }

            return true;
        } else {
            return [false, ["User Cancelled the Approval"]];
        }

    }


}