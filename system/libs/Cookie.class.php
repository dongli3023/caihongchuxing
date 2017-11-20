<?php
class Cookie
{
	/**
	 * 解密已经加密了的cookie
	 * 
	 * @param string $encryptedText
	 * @return string
	 */
	private static function _decrypt($encryptedText)
	{
		$config=base::load_cache("cache_set_config","_config");
		$key = $config['cookie'];
		$cryptText = base64_decode($encryptedText);
		$ivSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($ivSize, MCRYPT_RAND);
		$decryptText = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $cryptText, MCRYPT_MODE_ECB, $iv);
		return trim($decryptText);
	}

	/**
	 * 加密cookie
	 *
	 * @param string $plainText
	 * @return string
	 */
	private static function _encrypt($plainText)
	{
		$config=base::load_cache("cache_set_config","_config");
		$key = $config['cookie'];
		$ivSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($ivSize, MCRYPT_RAND);
		$encryptText = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $plainText, MCRYPT_MODE_ECB, $iv);
		return trim(base64_encode($encryptText));
	}
	
	/**
	 * 删除cookie
	 * 
	 * @param array $args
	 * @return boolean
	 */
	public static function _delcookie($args)
	{
		$name = $args['name'];
		$domain = isset($args['domain']) ? $args['domain'] : null;
		return isset($_COOKIE[$name]) ? setcookie($name, '', time() - 86400, '/', $domain) : true;
	}
	
	/**
	 * 得到指定cookie的值
	 * 
	 * @param string $name
	 */
	public static function _getcookie($name)
	{
		return isset($_COOKIE[$name]) ? self::_decrypt($_COOKIE[$name]) : null;
	}
	
	/**
	 * 设置cookie
	 *
	 * @param array $args
	 * @return boolean
	 */
	public static function _setcookie($args)
	{
		$name = $args['name'];
		$value= self::_encrypt($args['value']);
		$expire = isset($args['expire']) ? $args['expire'] : null;
		$path = isset($args['path']) ? $args['path'] : '/';
		$domain = isset($args['domain']) ? $args['domain'] : null;
		$secure = isset($args['secure']) ? $args['secure'] : 0;
		return setcookie($name, $value, $expire, $path, $domain, $secure);
	}
}
?>