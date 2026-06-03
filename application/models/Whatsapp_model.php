<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->config->load('whatsapp');
    }

    public function send_template_message($to, $template_name, $language_code, $parameters = array())
    {
        $token          = $this->config->item('whatsapp_token');
        $phoneNumberId  = $this->config->item('whatsapp_phone_number_id');
        $apiVersion     = $this->config->item('whatsapp_api_version');

        $url = "https://graph.facebook.com/".$apiVersion."/".$phoneNumberId."/messages";

        // Customer number format: country code without +, example UAE: 971501234567
        $components = array();

        if (!empty($parameters)) {
            $bodyParams = array();

            // foreach ($parameters as $param) {
            //     $bodyParams[] = array(
            //         "type" => "text",
            //         "text" => (string)$param
            //     );
            // }

            // foreach ($parameters as $param) {

            //     $text = trim((string)$param);

            //     if ($text === '') {
            //         $text = '-';
            //     }

            //     $bodyParams[] = array(
            //         "type" => "text",
            //         "text" => $text
            //     );
            // }

            foreach ($parameters as $param) {

                $text = trim((string)$param);

                // ✅ WhatsApp template params cannot contain newline/tab
                $text = str_replace(array("\r\n", "\r", "\n", "\t"), ' | ', $text);

                // ✅ remove more than 4 consecutive spaces
                $text = preg_replace('/\s{2,}/', ' ', $text);

                if ($text === '') {
                    $text = '-';
                }

                $bodyParams[] = array(
                    "type" => "text",
                    "text" => $text
                );
            }

            $components[] = array(
                "type" => "body",
                "parameters" => $bodyParams
            );
        }
        

        $payload = array(
            "messaging_product" => "whatsapp",
            "to" => $to,
            "type" => "template",
            "template" => array(
                "name" => $template_name,
                "language" => array(
                    "code" => $language_code
                )
            )
        );

        if (!empty($components)) {
            $payload["template"]["components"] = $components;
        }

        $jsonPayload = json_encode($payload);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer ".$token,
            "Content-Type: application/json"
        ));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error    = curl_error($ch);

        curl_close($ch);

        return array(
            "status" => ($httpCode >= 200 && $httpCode < 300),
            "http_code" => $httpCode,
            "response" => json_decode($response, true),
            "raw_response" => $response,
            "error" => $error
        );
    }
}