<?php
class AES {
		function __construct($options) {
			if (isset($options)) {
				$this->options = $options;
			} else {
				throw new Exception('Unable to set AES Options');
			}
		}
		public function encrypt() {
			if (isset($this->options['encryption_key'])) {
				if (isset($this->options['data_to_encrypt']) && !empty($this->options['data_to_encrypt'])) {
					return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->options['encryption_key'], $this->options['data_to_encrypt'], MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
				} else {
					throw new Exception('No data to be encrypted specified.');
				}
			} else {
				throw new Exception('No encryption key specified.');
			}
		}
		
		public function decrypt() {	
			if (isset($this->options['encryption_key'])) {
				if (isset($this->options['data_to_decrypt']) && !empty($this->options['data_to_decrypt'])) {
					return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->options['encryption_key'], base64_decode($this->options['data_to_decrypt']), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
				} else {
					throw new Exception('No data to be decrypted specified.');
				}
			} else {
				throw new Exception('No encryption key specified.');
			}
		}
	}
	
?>