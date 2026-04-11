<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 require_once dirname(__FILE__).'/../libraries/vendor/autoload.php'; 
class Welcome extends CI_Controller {
  

    public function index()
    {
        $this->load->view('welcome_message');
    }
    public function sendSMS()
    {
        
        $number = $this->input->post('number');
        $country = $this->input->post('country');
        
        $to = '+'.$country.$number;
        
        //require './Twilio/autoload.php';
        //https://github.com/Abdulla-nilam/Codeigniter-Twilio-SMS
        // Use the REST API Client to make requests to the Twilio REST API
        
        
        // Your Account SID and Auth Token from twilio.com/console
        $sid = 'ACbf1d2475ef52474d17e6d9339ac521a3';
        $token = '1a78d5ad299fd4091b07f6e3a95a8085';
        $client = new Twilio\Rest\Client($sid, $token);
        
        // Use the client to do fun stuff like send text messages!
        $client->messages->create(
        // the number you'd like to send the message to
            $to,
            array(
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+19402513528',
                // the body of the text message you'd like to send
                'body' => "Hey Abdulla! It's Works"
            )
        );
    }
}
