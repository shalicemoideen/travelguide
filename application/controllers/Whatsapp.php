<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp extends CI_Controller
{
    public function send_test()
    {
        $this->load->model('Whatsapp_model');

        $customerNumber = "918137915236"; // without +

        $templateName = "order_update_test"; 
        $languageCode = "en";

        // Example template:
        // Hi {{1}},
        // Thank you for your purchase! Your order number is {{2}}.
        // Estimated delivery: {{3}}.

        $params = array(
            "Shereef",
            "ORD12345",
            "Tomorrow"
        );

        $result = $this->Whatsapp_model->send_template_message(
            $customerNumber,
            $templateName,
            $languageCode,
            $params
        );

        echo "<pre>";
        print_r($result);
        echo "</pre>";
    }
}