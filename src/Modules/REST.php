<?php

namespace Curl\Modules;

use Curl\CurlRequest;
use Curl\HTTP;

/**
 * Description of REST
 *
 * @author eric
 */
class REST extends CurlRequest
{
  
  public function __construct($url = null, $params = array()) {

    
    parent::__construct($url, $params);
  }
  
  public function delete($url, $params = array()) {
    $this->url($url)->setMethod(HTTP::DELETE);
    $this->postFields($params);
    return $this->send();
  }
  
  public function get($url, $params = array()) {
    $this->url($url)->setMethod(HTTP::GET);
    return $this->send();
  }
  
  public function head($url, $params = array()) {
    $this->url($url)->setMethod(HTTP::HEAD);
    return $this->send();
  }
  
  public function patch($url, $params = array()) {
    $this->url($url)->setMethod(HTTP::PATCH);
    $this->postFields($params);
    return $this->send();
  }
  
  public function post($url, $params = array()) {
    $this->url($url)->setMethod(HTTP::POST);
    $this->postFields($params);
    return $this->send();
  }
  
  public function put($url, $params = array()) {
    $this->url($url)->setMethod(HTTP::PUT);
    $this->postFields($params);
    return $this->send();
  }
  
  /**
   * Sets the content type to application/json
   * @return bool.
   */
  public function setJSONContent() {
    $this->protectHandle('set content type');
    curl_setopt($this->handle, CURLOPT_HTTPHEADER, array(                                                                          
      HTTP::CONTENT_TYPE_JSON
    ));
    return $this;
  }
}