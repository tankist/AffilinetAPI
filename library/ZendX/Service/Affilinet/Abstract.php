<?php

abstract class ZendX_Service_Affilinet_Abstract
{

    const API_ENDPOINT = 'https://api.affili.net/V2.0/';

    const API_SANDBOX_ENDPOINT = 'https://developer-api.affili.net/V2.0/';

    const API_TIMEZONE = 'Europe/Berlin';

    /**
     * @var Zend_Soap_Client
     */
    protected $_client = null;

    /**
     * @var Zend_Soap_Client
     */
    protected $_logonClient = null;

    /**
     * @var string
     */
    protected $_wsdlPath = '';

    protected $_logonWsdlPath = 'Logon.svc?wsdl';

    protected $_serviceType = '';

    /**
     * @var string
     */
    protected $_token;

    /**
     * @var Zend_Date
     */
    protected $_tokenExpireDate = null;

    /**
     * @var string
     */
    protected $_username = '';

    /**
     * @var string
     */
    protected $_password = '';

    /**
     * @var int
     */
    protected $_sandboxPublisherId = null;

    /**
     * @var Zend_Cache_Core
     */
    protected static $_cache = null;

    /**
     * @param Zend_Cache_Core $cache
     */
    public static function setCache(Zend_Cache_Core $cache)
    {
        self::$_cache = $cache;
    }

    /**
     * @return Zend_Cache_Core
     */
    public static function getCache()
    {
        return self::$_cache;
    }

    /**
     * @throws ZendX_Service_Affilinet_Exception
     * @param bool $useSandbox
     * @param array $options
     * @param array $soapOptions
     */
    public function __construct($useSandbox = false, $options = array(), $soapOptions = array())
    {
        if (empty($this->_wsdlPath)) {
            throw new ZendX_Service_Affilinet_Exception('WSDL path must be defined to perform API calls');
        }
        $wsdl = (($useSandbox)?self::API_SANDBOX_ENDPOINT:self::API_ENDPOINT) . $this->_wsdlPath;
        $logonWsdl = (($useSandbox)?self::API_SANDBOX_ENDPOINT:self::API_ENDPOINT) . $this->_logonWsdlPath;

        $this->setOptions($options);
        $this->_client = new Zend_Soap_Client($wsdl, $soapOptions);
        $this->_logonClient = new Zend_Soap_Client($logonWsdl, $soapOptions);
        
        $this->_client->setSoapVersion(SOAP_1_1);
        $this->_logonClient->setSoapVersion(SOAP_1_1);
    }

    /**
     * @param array $options
     * @return self
     */
    public function setOptions($options = array())
    {
        foreach ($options as $name => $option) {
            $setter = 'set' . ucfirst($name);
            if (method_exists($this, $setter)) {
                call_user_func(array($this, $setter), $option);
            }
        }
        return $this;
    }

    /**
     * @param Zend_Soap_Client $client
     * @return self
     */
    public function setClient(Zend_Soap_Client $client)
    {
        $this->_client = $client;
        return $this;
    }

    /**
     * @return Zend_Soap_Client
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * @param string $password
     * @return self
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param string $username
     * @return self
     */
    public function setUsername($username)
    {
        $this->_username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @param $sandboxPublisherId
     * @return self
     */
    public function setSandboxPublisherId($sandboxPublisherId)
    {
        $this->_sandboxPublisherId = $sandboxPublisherId;
        return $this;
    }

    /**
     * @return int
     */
    public function getSandboxPublisherId()
    {
        return $this->_sandboxPublisherId;
    }

    /**
     * @return bool
     */
    public function isLoggedIn()
    {
        return ($this->_token && !$this->_isTokenExpired());
    }

    /**
     * @throws ZendX_Service_Affilinet_Exception
     * @param string $username
     * @param string $password
     * @return self
     */
    public function logon($username, $password)
    {
        $params = array(
            'Username' => $username,
            'Password' => $password,
            'WebServiceType' => $this->_serviceType
        );

        if (strpos($this->_logonClient->getWsdl(), self::API_SANDBOX_ENDPOINT) !== false) {
            $params['DeveloperSettings'] = array(
                'SandboxPublisherID' => $this->getSandboxPublisherId()
            );
        }

        try {
            $this->_token = $this->_logonClient->Logon($params);
            $this->_cache('logonToken', $this->_token);
        } catch (SoapFault $e) {
            $exception = new ZendX_Service_Affilinet_Exception('Login failed');
            throw $exception->setSoapException($e);
        }
        return $this;
    }

    /**
     * @param array $params
     * @return void
     */
    protected function _preRequest($params = array())
    {
        if (!$this->isLoggedIn()) {
            $this->logon($this->getUsername(), $this->getPassword());
        }
    }

    /**
     * @param mixed $method
     * @param array $params
     * @return mixed
     */
    protected function _request($method, $params = array())
    {
        $this->_preRequest($params);
        if (!array_key_exists('CredentialToken', $params)) {
            $params['CredentialToken'] = $this->_getToken();
        }
        $response = call_user_func(array($this->_client, $method), $params);
        $this->_postRequest($response, $params);
        return $response;
    }

    /**
     * @param mixed $response
     * @param array $params
     * @return mixed
     */
    protected function _postRequest($response, $params = array())
    {

    }

    /**
     * @return string
     */
    protected function _getToken()
    {
        if (!$this->_token) {
            if ($this->_token = $this->_cache('logonToken')) {
                $this->_token = $this->logon($this->getUsername(), $this->getPassword());
                $this->_cache('logonToken', $this->_token);
            }
        }
        return $this->_token;
    }

    /**
     * @return bool
     */
    protected function _isTokenExpired()
    {
        if (!($this->_tokenExpireDate instanceof Zend_Date)) {
            if (!$this->_tokenExpireDate = $this->_cache('tokenExpireDate')) {
                $expireDate = $this->_logonClient->GetIdentifierExpiration($this->_getToken());
                $this->_tokenExpireDate = self::getServerDateObject($expireDate);
                $cacheTime = clone($this->_tokenExpireDate);
                self::getCache()->save(
                    $this->_tokenExpireDate, 'tokenExpireDate', array(),
                    $cacheTime->sub(Zend_Date::now())->get(Zend_Date::MINUTE) * 60
                );
            }
        }
        return ($this->_tokenExpireDate->compare(Zend_Date::now()) < 0);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return bool|false|mixed
     */
    protected function _cache($key, $value = null)
    {
        if (!($cache = self::getCache())) {
            return false;
        }
        if ($value !== null) {
            $cache->save($value, $key);
            return true;
        }
        return $cache->load($key);
    }

    public static function getServerDateObject($dateString)
    {
        $dateObject = new Zend_Date();
        if (is_string($dateString)) {
            list($date, $time) = explode('T', $dateString);
            $oldTimezone = $dateObject->getTimezone();
            $dateObject->setTimezone(self::API_TIMEZONE);
            $dateObject->setDate($date, 'y-MM-dd')->setTime($time);
            $dateObject->setTimezone($oldTimezone);
        }
        return $dateObject;
    }

}