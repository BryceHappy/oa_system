<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once('phpmailer/class.phpmailer.php');
class My_mailer extends PHPMailer {

    public function __construct()
    {
        $this->IsSMTP(); //設定使用SMTP方式寄信 
        $this->SMTPAuth = true; //設定SMTP需要驗證 
        $this->SMTPSecure = "ssl"; // Gmail請服用 
        $this->Host = "smtp.gmail.com"; //Gmail請服用 
        // $this->Host = 'ssl://smtp.gmail.com:465'; 
        // $this->Host = "這邊是smtp"; //Gamil的SMTP主機 
        $this->Port = 465; //Gamil的SMTP主機的SMTP埠位為465埠。 
        $this->CharSet = "utf-8"; //設定郵件編碼 
        $this->Encoding = "base64";
        $this->FromName = "Bryce";
        $this->Username = 'bryce.happy'; //設定驗證帳號 
        $this->Password = "BryceHappy"; //設定驗證密碼  
        $this->From = 'bryce.happy@gmail.com'; //設定寄件者信箱
        $this->IsHTML(true); //設定郵件內容為HTML   
    }


    function sendEmail($RecipientName,$RecipientAddress,$Subject,$Body)
    {
        if( $RecipientName!="" && $RecipientAddress!="" && $Subject!="" && $Body!="" )
        {
             $this->Subject = $Subject; //設定郵件標題        
             $this->Body = $Body; //設定郵件內容       
             $this->AddAddress($RecipientAddress, $RecipientName); //設定收件者郵件及名稱   

             if(!$this->Send()) {        
                $str = "Mailer Error: " . $this->mail->ErrorInfo;        
             } else {        
                $str =  "Message sent!";        
             }
            return $str;      
        }
    }
}

/**
class My_mailer  {

    public function __construct()
    {
        require_once('phpmailer/class.phpmailer.php');
        $this->mail             = new PHPMailer();
		$this->mail->IsSMTP(); //設定使用SMTP方式寄信 
		$this->mail->SMTPAuth = true; //設定SMTP需要驗證 
		$this->mail->SMTPSecure = "ssl"; // Gmail請服用 
		$this->mail->Host = "smtp.gmail.com"; //Gmail請服用 
        // $this->mail->Host = 'ssl://smtp.gmail.com:465'; 
		// $this->mail->Host = "這邊是smtp"; //Gamil的SMTP主機 
		$this->mail->Port = 465; //Gamil的SMTP主機的SMTP埠位為465埠。 
		$this->mail->CharSet = "utf-8"; //設定郵件編碼 
		$this->mail->Encoding = "base64";
        $this->mail->FromName = "Bryce";
		$this->mail->Username = 'bryce.happy'; //設定驗證帳號 
		$this->mail->Password = "BryceHappy"; //設定驗證密碼	
		$this->mail->From = 'bryce.happy@gmail.com'; //設定寄件者信箱
		$this->mail->IsHTML(true); //設定郵件內容為HTML   
    }


    function sendEmail($RecipientName,$RecipientAddress,$Subject,$Body)
    {
        if( $RecipientName!="" && $RecipientAddress!="" && $Subject!="" && $Body!="" )
        {
             $this->mail->Subject = $Subject; //設定郵件標題        
             $this->mail->Body = $Body; //設定郵件內容       
             $this->mail->AddAddress($RecipientAddress, $RecipientName); //設定收件者郵件及名稱   

             if(!$this->mail->Send()) {        
                $str = "Mailer Error: " . $this->mail->ErrorInfo;        
             } else {        
                $str =  "Message sent!";        
             }
            return $str;      
        }
    }
}
**/
	
?>