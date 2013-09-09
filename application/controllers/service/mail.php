<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends A_Controller {

	function __construct(){

	parent::__construct();

	$this->load->library('My_mailer');
	$this->file_name = 'service/';

	}

	function index(){

   $this->load->library('ckeditor');
   $this->load->library('ckfinder');
   $this->ckeditor = new CKEditor();
   $this->ckeditor->basePath = 'http://localhost/oa_system/resources/ckeditor/';
   $this->ckeditor->config['toolbar'] = 'Full';

   CKFinder::SetupCKEditor($this->ckeditor, 'resources/ckfinder/');

	$view_datas['title'] = '發送mail';

	if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            
            //get input data
            $temp_post = $this->input->post();

            if ($temp_post['to'] != '' && $temp_post['who'] != '' && $temp_post['subject'] != '' && $temp_post['body'] != '' ) {
            	$send_data = array(
            		'RecipientName' => $temp_post['who'],
            		'RecipientAddress' => $temp_post['to'],
            		'Subject' => $temp_post['subject'],
            		'Body' => $temp_post['body']
            		);
            	$send = $this->my_mailer->sendEmail($send_data['RecipientName'] ,$send_data['RecipientAddress'],$send_data['Subject'],$send_data['Body']);
				$view_datas['status'] = $send;
            	$action = true;
            } else {
                $action = flase;
            }
            
            $view_datas['submit_info'] = $action ? array(
                'title' => '已發送'
            ) : array(
                'title' => '發送失敗'
            );
        }

	$this->load->view($this->file_name . 'mail_message', $view_datas);

	}
}