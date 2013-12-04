<?
require_once("define_curl.php");
class CURL {
	var $callback = false;
	var $async = false;
	var $header = false;
	var $cookie = false;
	var $http_code;
	var $login;
	var $password;
	var $userpwd;
	var $referer;

	function setCallback($func_name)
	{
		$this->callback = $func_name;
	}

	function doRequest($method, $url, $vars)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);

		if (substr($url, 0, 5) == 'https')//設定SSL
		{
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		}
		if ($this->header)
		{
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (	; U; Windows NT 6.1; en-US) AppleWebKit/534.16 (KHTML, like Gecko) Chrome/10.0.648.204 Safari/534.16');
		}
//		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);//「是否截取header的資訊」
		curl_setopt($ch, CURLOPT_TIMEOUT, 86400);//設置curl允許執行的最長秒數
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//「將結果回傳成字串」
		if ($this->cookie)
		{
			curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookie.txt');
			curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookie.txt');
		}
		if (!empty($this->login))
		{
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER,
				array("HTTP_AUTH_LOGIN: {$this->login}",
							"HTTP_AUTH_PASSWD: {$this->password}",
							"HTTP_PRETTY_PRINT: TRUE",
							"Content-Type: text/xml"));
		}
		if (!empty($this->userpwd))
		{
			curl_setopt($ch, CURLOPT_USERPWD, $this->userpwd);
		}

		switch ($method)
		{
			case 'POST':
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
				break;
			case 'PUT':
				curl_setopt($ch, CURLOPT_HTTPHEADER,
	  			array("HTTP_PRETTY_PRINT: TRUE",
					  		"Accept: application/json",
					  		"Content-Type: application/json"));
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
				break;
			case 'DELETE':
				curl_setopt($ch, CURLOPT_HTTPHEADER,
	  			array("HTTP_PRETTY_PRINT: TRUE",
					  		"Accept: application/json",
					  		"Content-Type: application/json"));
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
				break;
		}
//		if ($method == 'POST')
//		{
//			curl_setopt($ch, CURLOPT_POST, 1);
//			curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
//		}
		
		if ($this->async)
		{
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT_MS, $this->async);
		}
		if ($this->referer) {
			curl_setopt( $ch , CURLOPT_REFERER , $this->referer );
		}
		$data = curl_exec($ch);
//		echo $data;
//		exit;
		if (curl_errno($ch) && !$this->async)
			echo curl_error($ch);
		$this->http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//		curl_close($ch);
		if ($data)
		{
			if ($this->callback)
			{
			   $callback = $this->callback;
			   $this->callback = false;
			   return call_user_func($callback, $data);
			}
			else
			   return $data;
		}
		else
			return ''; //curl_error($ch) . ':' . curl_error($ch);
	}

	function get($url) {//ex:jason-sd.lib.tw/crawlerbid/crawlerbid.php?website='.$website.'&page='.$page
	   return $this->doRequest('GET', $url, 'NULL');
	}
	
	function delete($url) {
	   return $this->doRequest('DELETE', $url, 'NULL');
	}
	
	function put($url, $vars)
	{
		if (is_array($vars))
		{
			foreach ($vars as $k => $v)
				$vars[$k] = $k . '=' . urlencode($v);
			$vars = implode('&', $vars);
		}
		$r = $this->doRequest('PUT', $url, $vars);
	  return $r;
	}

	function post($url, $vars) {
		if (is_array($vars))
		{
			foreach ($vars as $k => $v)
				$vars[$k] = $k . '=' . urlencode($v);
			$vars = implode('&', $vars);
		}
	  return $this->doRequest('POST', $url, $vars);
//		if (!empty($this->login))
//		{
//			$vars = str_replace("\n", '', $vars);
//			$vars = str_replace("\r", '', $vars);
//			$vars = str_replace('!', '\!', $vars);
//			$vars = str_replace('"', '\"', $vars);
//			$pw = str_replace('!', '\!', $this->password);
//			$curl = "curl -k -H \"HTTP_AUTH_LOGIN: {$this->login}\" -H \"HTTP_AUTH_PASSWD: {$this->password}\" -H \"HTTP_PRETTY_PRINT: TRUE\" -H \"Content-Type: text/xml\" --connect-timeout 30 \"$url\" --data-binary \"$vars\"";
//		}
//		else
//		{
//			if (is_array($vars))
//			{
//				unset($s);
//				foreach ($vars as $k => $v)
//					$s[] = "$k=" . urlencode($v);
//				$vars = implode('&', $s);
//			}
//			$curl = "curl -k --connect-timeout 30 \"$url\" --data-binary \"$vars\"";
//		}
//
////		$curl = "curl -k -H \"HTTP_AUTH_LOGIN: {$this->login}\" -H \"HTTP_AUTH_PASSWD: {$pw}\" -H \"HTTP_PRETTY_PRINT: TRUE\" -H \"Content-Type: text/xml\" --connect-timeout 10 \"$url\" --data-binary \"$vars\"";
////		$curl = "curl -k -u {$this->login}:{$pw} -H \"HTTP_PRETTY_PRINT: TRUE\" -H \"Content-Type: text/xml\" --connect-timeout 10 \"$url\" --data-binary \"$vars\"";
//		$r = `$curl`;
//		return substr($r, 0, 4) == 'curl' ? null : $r;
	}
}
?>