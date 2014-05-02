<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	private static $instance;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;
		
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();
		
		log_message('debug', "Controller Class Initialized");


		header('Content-type:text/html; charset=utf-8');
		date_default_timezone_set('Asia/Taipei');
		
		$config_common = $this->m_common->get_one('config_common');
		$config_site = $this->m_common->get_one('config_site');
		
		define('SITE_RESOURCES',            base_url() . $config_common['site_resources']);
		define('SITE_COMMON_STATIC',        base_url() . $config_common['site_static']);
		define('SITE_UPLOADS',              base_url() . $config_common['site_uploads']);
		define('SITE_THEMES',               $config_common['site_themes']);
		define('SITE_ENCRYPTION_KEY_BEGIN', $config_common['site_encryption_key_begin']);
		define('SITE_ENCRYPTION_KEY_END',   $config_common['site_encryption_key_end']);
		define('SITE_UPLOAD_IMAGE_SIZE',    $config_common['site_upload_image_size']);
		define('SITE_UPLOAD_FLASH_SIZE',    $config_common['site_upload_flash_size']);
		define('SITE_UPLOAD_MEDIA_SIZE',    $config_common['site_upload_media_size']);
		define('SITE_UPLOAD_FILE_SIZE',     $config_common['site_upload_file_size']);
		
		define('SITE_NAME',                 $config_site['site_name']);
		define('SITE_LOGO',                 SITE_COMMON_STATIC . '/site/' . $config_site['site_theme'] . '/' . $config_site['site_logo']);
		define('SITE_ICP',                  $config_site['site_icp']);
		define('SITE_STATISTICAL_CODE',     $config_site['site_statistical_code']);
		define('SITE_SHARE_CODE',           $config_site['site_share_code']);
		define('SITE_KEYWORDS',             $config_site['site_keywords']);
		define('SITE_DESCRIPTION',          $config_site['site_description']);
		define('SITE_STATUS',               $config_site['site_status']);
		define('SITE_CLOSE_REASON',         $config_site['site_close_reason']);
		define('SITE_REG_AGREEMENT',        $config_site['site_reg_agreement']);
		define('SITE_THEME',                SITE_THEMES . '/' . $config_site['site_theme']);
		
		unset($config_common, $config_site);
		
		define('SITE_STATIC', SITE_COMMON_STATIC . '/site/' . str_replace(SITE_THEMES . '/', '', SITE_THEME));

		define('INDEX_URL','login');

	}

	public static function &get_instance()
	{
		return self::$instance;
	}
}
// END Controller class


class A_Controller extends CI_Controller
{
	function __construct()
	{
	
		parent::__construct();
		// 後台登入驗證處理

		$this->load->model('admin/m_index');
		$session = $this->m_index->get_session();

		if($this->uri->uri_string === INDEX_URL)
		{
			if($session['admin_uid'] && $session['admin_username'])
			{
				redirect('admin');
			}
		} else {
			if(!$session['admin_uid'] || !$session['admin_username'])
			{
				redirect('login');
			}
		}
		
		$config_site_admin = $this->m_common->get_one('config_site_admin');
		define('SITE_ADMIN_NAME', $config_site_admin['site_admin_name']);
		define('SITE_ADMIN_LOGO', SITE_COMMON_STATIC . '/admin/' . $config_site_admin['site_admin_theme'] . '/' . $config_site_admin['site_admin_logo']);
		define('SITE_ADMIN_THEME', $config_site_admin['site_admin_theme']);
		
		unset($config_site_admin);
		
		define('SITE_ADMIN_STATIC', SITE_COMMON_STATIC . '/admin/' . SITE_ADMIN_THEME);
		// $this->load->set_admin_template(SITE_ADMIN_THEME);
	}
	
	/**
	 * ?查是否具有訪問權限
	 * 
	 * @access   public
	 * @param    string    權限名稱
	 * @param    boolean   是否傳回值
	 * @return   
	 */
	function check_power($page_name, $return = FALSE)
	{
		$check_power = $this->m_index->check_power($page_name);
		if(!$check_power)
		{
			if($return)
			{
				return FALSE;
			}
			die("No Powerful Can User");
		}
		return $page_name;
	}
}

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */