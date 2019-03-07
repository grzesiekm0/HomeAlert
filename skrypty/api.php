<?php
namespace SerwerSMS;
class SerwerSMS {
	public $user;
	public $pass;
	public $api_url = 'https://api.mobitex.pl/sms.php';
	public $format = 'json';
	public $text;
	public $type;
	public $number;
	public $from;
	public $ext_id;
	public $tamplates;
	public $error;
	public function __construct($user, $pass) {
		if (!$user) {
			throw new Exception('Username is empty');
		}
		if (!$pass) {
			throw new Exception('Password is empty');
		}
		$this->user = $user;
		$this->pass = $pass;
		$this->text = new Text($this);
		$this->type = new Type($this);
		$this->number = new Number($this);
		$this->from = new From($this);
		$this->ext_id = new Ext_id($this);
		$this->templates = new Templates($this);
		$this->error = new Error($this);
	}
	public function call($url, $params = array()) {
		$params['user'] = $this->user;
		$params['pass'] = $this->pass;
        $params['system'] = 'client_php';
		$curl = curl_init($this->api_url . '/' . $url . '.' . $this->format);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		$answer = curl_exec($curl);
		if (curl_errno($curl)) {
			throw new Exception('Failed call: ' . curl_error($curl), curl_errno($curl));
		}
        
        $http_code = curl_getinfo($curl,CURLINFO_HTTP_CODE);
        if($http_code != 200){
            throw new Exception('Unexpected HTTP code', $http_code);
        }
        
		curl_close($curl);
		if ($this->format == 'xml') {
            $result = simplexml_load_string($answer);
            if(isset($result->code) and isset($result->type) and isset($result->message)){
                throw new Exception($result->message,(int) $result->code);
            }
        } else {
            $result = json_decode($answer);
            if(isset($result->error)){
                throw new Exception($result->error->message,(int) $result->error->code);
            }
        }
        return $result;
	}
}