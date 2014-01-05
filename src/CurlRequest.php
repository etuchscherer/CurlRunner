<?php

namespace Curl;

use Curl\CurlException;

/**
 * Description of CurlRequest
 *
 * @author eric
 */
class CurlRequest
{
  /**
   * Array of configured params
   * @var array
   */  
  protected $config;

  /**
   * Curl Errors;
   * @var string
   */
  protected $errors;

  /**
   * The cURL handle.
   * @var resource
   */
  public $handle;
  
  /**
   * Parameters to post
   * @var array
   */
  protected $postFields;

  /**
   * The response
   * @var string
   */
  public $response;
  
  /**
   * The user agent;
   * @var string
   */
  public $userAgent;

  /**
   * Currently configured url
   * @var string
   */
  public $url;

  public function __construct($url = null, $params = array()) {
    $this->userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Curl/PHP '.PHP_VERSION;
    $this->initSession();

    if ($url) {
      $this->url($url);
    }
  }

  public function __destruct() {
    $this->closeSession();
  }

  /**
   * Clears any set errors.
   * @return void;
   */
  public function clearErrors() {
    return $this->errors = null;
  }

  /**
   * Returns cURL errors;
   * @return string
   */
  public function errors() {
    return $this->errors;
  }
    
  /**
   * Returns true if received errors.
   * @return boolean
   */
  public function hasErrors() {
    return !is_null($this->errors());
  }

  /**
   * Returns info about the last
   * transfer.
   * @param int $option
   * @return mixed If opt is given, returns its value. 
   * Otherwise, returns an associative array.
   * @link http://us3.php.net/manual/en/function.curl-getinfo.php Documentation
   */
  public function info($option = null) {
    return curl_getinfo($this->handle, $option);
  }

  /**
   * Returns true when the cURL handle is initialized.
   * @return boolean
   */
  public function isInitialized() {
    return $this->handle !== false;
  }
  
  /**
   * 
   * @param array $params
   */
  public function postFields($params = null) {
    $this->protectHandle('set post fields');
    
    if (is_array($params)) {
      return curl_setopt($this->handle, CURLOPT_POSTFIELDS, $params);
    }
    return $this->postFields;
  }

  /**
   * Re-initializes all options set on the 
   * given cURL handle to the default values
   * @return void;
   */
  public function reset() {
    $this->closeSession();
    $this->initSession();
  }

  /**
   * Returns true on success and false on failure.
   * @return boolean
   */
  public function send() {

    if (!$this->isInitialized() || !$this->url) {
      $this->throwUninitializedException('send request');
    }

    $this->clearErrors();
    return curl_exec($this->handle);
  }

  /**
   * Sets the curl method.
   * @param integer $option The CURLOPT_XXX option to set.
   * @param boolean $value The value to be set on option.
   * @return \CurlRequest\CurlRequest
   */
  public function setMethod($method, $value = true) {

    $this->protectHandle('set method');

    switch (strtoupper($method)) {
        case 'HEAD':
            curl_setopt($this->handle, CURLOPT_NOBODY, $value);
            break;
        case 'GET':
            curl_setopt($this->handle, CURLOPT_HTTPGET, $value);
            break;
        case 'POST':
            curl_setopt($this->handle, CURLOPT_POST, $value);
            break;
        default:
            curl_setopt($this->handle, CURLOPT_CUSTOMREQUEST, $method);
    }
    return $this;
  }

  /**
   * Returns the Last received HTTP code
   * @return int
   */
  public function status() {
    return $this->info(CURLINFO_HTTP_CODE);
  }

  /**
   * Throws a CurlException, with formattable message.
   * @param string $action
   * @throws CurlException
   */
  public function throwUninitializedException($action) {
    $msg = sprintf('Can not %s, cURL is not initialized', $action);
    throw new CurlException($msg);
  }

  /**
   * Sets an url if provided, otherwise
   * returns the currently set url. 
   * @param string $url
   * @return string
   */
  public function url($url = null) {
    if ($url === null) {
      return $this->url;
    }
    return $this->setUrl($url);
  }

  /**
   * Closes a cURL session and frees all resources. 
   * The cURL handle, ch, is also deleted
   * @return void;
   */
  private function closeSession() {
    if ($this->isInitialized()) {
      curl_close($this->handle);
      $this->handle = null;
      $this->url = null;
      $this->returnTransfer = true;
    }
    return;
  }

  /**
   * Returns a cURL handle on success, FALSE on errors.
   * @param resource $url
   */
  private function initSession($url = null) {
    $this->handle = curl_init($url);
    curl_setopt($this->handle, CURLOPT_USERAGENT, $this->userAgent);
    
    return $this->handle;
  }

  /**
   * Throws an exception if the handle is uninitialized.
   * @param string $action action were protecting the handle from
   */
  private function protectHandle($action) {
    if (!$this->isInitialized()) {
      $this->throwUninitializedException($action);
    }
  }

  /**
   * Sets the url to the resource and class
   * variable.
   * @param string $url
   * @return \CurlRequest\CurlRequest
   */
  private function setUrl($url) {
    $this->protectHandle('set url');

    $this->url = $url;
    curl_setopt($this->handle, CURLOPT_URL, $this->url);
    return $this;
  }
}