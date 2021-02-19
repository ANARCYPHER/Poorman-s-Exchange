<?php  

/* 
|--------------------------------------------------------
| SEND SMS API (Nexmo, Twilio, BudgetSMS, Infobip)
| @author : Md. Tareq Rahman
| @email  : <sourav.diubd@gmail.com>
| @created at: 21 Dec 2017
|--------------------------------------------------------
| $this->load->library('sms_lib');
| $this->sms_lib->send(array(
|     'to'       => +8801746406801, 
|     'template' => 'Hello %x%', 
|     'template_config' => array('x'=>'Mr. X'), 
| ));
|--------------------------------------------------------
*/
 
class Sms_lib
{

    public function send($config = array())
    {    

        $CI =& get_instance();
        $sms = $CI->db->select('*')->from('email_sms_gateway')->where('es_id', 1)->get()->row();

        $url      = $sms->host;
        $api      = $sms->api;
        $username = $sms->user;
        $userid   = $sms->userid;
        $password = $sms->password;
        $from     = $sms->title;


        $message = $config['template'];
        
        if (is_array($config['template_config']) && sizeof($config['template_config']) > 0)
        {
            $message = $this->_template($config['template'], $config['template_config']);
        }

        if ($sms->gatewayname=='budgetsms') {
            /****************************
            * budgetsms Gateway Setup
            ****************************/
            // URL https://api.budgetsms.net/sendsms/?

            $data = array(
                'handle'   => $api,
                'username' => $username,
                'userid'   => $userid,
                'from'     => $from,
                'msg'      => $message,
                'to'       => $config['to']
            );


            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);    

            if(curl_errno($ch)) 
            {      
                return json_encode(array(
                    'status'      => false,
                    'message'     => 'Curl error: ' . curl_error($ch)
                ));
            } else {    
                return json_encode(array(
                    'status'      => true,
                    'message'     => "success: ". $response
                ));  
            }   

            curl_close($ch);

        }else if ($sms->gatewayname=='infobip') {
            /****************************
            * Infobip Gateway Setup
            ****************************/
            // https://api.infobip.com/sms/1/text/single
            // $username
            // $password

            $data = array(
                'from'     => $from,
                'text'     => $message,
                'to'       => $config['to']
            );

            $username = $username;
            $password = $userid;
            $header = "Basic " . base64_encode($username . ":" . $password);


            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "$url",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: $header",
                "content-type: application/json"
              ),
            ));

            $response = curl_exec($curl);    
            if(curl_errno($curl)) 
            {      
                return json_encode(array(
                    'status'      => false,
                    'message'     => 'Curl error: ' . curl_error($curl)
                ));
            } else {    
                return json_encode(array(
                    'status'      => true,
                    'message'     => "success: ". $response
                ));  
            }
            curl_close($ch);


        }else if ($sms->gatewayname=='smsrank') {
            /****************************
            * SMSRank Gateway Setup
            ****************************/
            // http://api.smsrank.com/sms/1/text/singles
            // $username
            // $password

            $password=base64_encode($password); 
            $message=base64_encode($message);
            $recipients = $config['to'];
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, "$url?username=$username&password=$password&to=$recipients&text=$message");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
            curl_setopt($curl, CURLOPT_USERAGENT, $agent);
            $output = json_decode(curl_exec($curl), true);
            
            return  true;

            curl_close($curl);


        }else if ($sms->gatewayname=='nexmo') {
            /****************************
            * NEXMO Gateway Setup
            ****************************/
            // # Linux/MacOS
            // curl.cainfo = "/etc/pki/tls/cacert.pem"
            // # Windows
            // curl.cainfo = "C:\php\extras\ssl\cacert.pem"

            // NEXMO_API_KEY =f19c49c5
            // NEXMO_API_SECRET =t43ZQoQqxmQpq7lQ

            $data = array(
                'from'     => $from,
                'text'     => $message,
                'to'       => $config['to']
            );

            require_once APPPATH.'libraries/sms-sdk/nexmo/vendor/autoload.php';

            $basic  = new \Nexmo\Client\Credentials\Basic($api, $password);
            $client = new \Nexmo\Client($basic);

            $message = $client->message()->send($data);


            if(!$message) 
            {      
                return json_encode(array(
                    'status'      => false,
                    'message'     => 'Curl error: '
                ));
            } else {    
                return json_encode(array(
                    'status'      => true,
                    'message'     => "success: "
                ));  
            }


        }else if ($sms->gatewayname=='twilio') {

            /****************************
            * Twilio Gateway Setup ON DEVELOPMENT
            ****************************/
            // require_once APPPATH.'sms-sdk/twilio/vendor/autoload.php';

            // // From Number +13852172064
            // // From Number +15005550006

            // // use Twilio\Rest\Client;

            // // Your Account SID and Auth Token from twilio.com/console
            // $sid = 'AC5a24c1a5be855f3ee3900aad6856c93e';
            // $token = '0b7c287c1bcd46ae4b3a629e685527c7';
            // // In production, these should be environment variables. E.g.:
            // // $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

            // // A Twilio number you own with SMS capabilities

            // $twilio = new Twilio\Rest\Client($sid, $token);

            // $message = $twilio->messages
            //             ->create("+8801746406801",
            //                 array(
            //                    'body' => "Let's grab lunch at Milliways tomorrow!",
            //                    'from' => "+15005550006"
            //                 )
            //             );

            // print_r($message);


            // if(!$message) 
            // {      
            //     return json_encode(array(
            //         'status'      => false,
            //         'message'     => 'Curl error: '
            //     ));
            // } else {    
            //     return json_encode(array(
            //         'status'      => true,
            //         'message'     => "success: "
            //     ));  
            // }

        }
        
    }


    private function _template($template = null, $data = array())
    {
    
        $newStr = $template;
        foreach ($data as $key => $value) {
            $newStr = str_replace("%$key%", $value, $newStr);
        } 
        return $newStr; 

         
    }

 
}
 



 

