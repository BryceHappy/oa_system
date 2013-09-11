<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends A_Controller
{
    function __construct()
    {
        parent::__construct();
    $this->load->library('ckeditor');
    $this->load->library('ckfinder');

    }

    function index()
    {
        $view_datas['title'] = 'ckeditor';
        $this->ckeditor->basePath = base_url().'resource/ckeditor/';
        // $this->ckeditor->basePath = SITE_RESOURCES.'/ckeditor/';
        // $this->ckeditor->config['toolbar'] = array(
        //                 array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
        //                                                     );
        $this->ckeditor->config['toolbar'] = 'Full';
        $this->ckeditor->config['language'] = 'zh-tw';
        $this->ckeditor->config['width'] = '800px';
        $this->ckeditor->config['height'] = '300px';            

        //Add Ckfinder to Ckeditor
        // $this->ckfinder->SetupCKEditor($this->ckeditor,SITE_RESOURCES.'/ckeditor/');
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../resources/ckfinder/'); 
        $this->load->view('ckeditor', $view_datas);
    }

}