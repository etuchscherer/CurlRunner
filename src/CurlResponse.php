<?php

namespace Curl;

/**
 * Parses the response from a Curl request into an object.
 *
 * @author Eric Tuchscherer
**/
class CurlResponse {
    
    /**
     * The body of the response without the headers block
     *
     * @var string
    **/
    public $body = '';
    
    /**
     * An associative array containing the response's headers
     *
     * @var array
    **/
    public $headers = array();
    
    /**
     * Accepts the result of a curl request as a string
     * @param string $response
    **/
    function __construct($response) {
      $this->response = $response;

      # Headers regex
      $pattern = '#HTTP/\d\.\d.*?$.*?\r\n\r\n#ims';

      # Extract headers from response
      preg_match_all($pattern, $response, $matches);
      $headers_string = array_pop($matches[0]);

      $this->setHeaders($headers_string);

      # Remove headers from the response body
      $this->setBody(str_replace($headers_string, '', $response));
        
//        # Extract the version and status from the first header
//        $version_and_status = array_shift($headers);
//        
//        preg_match('#HTTP/(\d\.\d)\s(\d\d\d)\s(.*)#', $version_and_status, $matches);
//        $this->headers['Http-Version'] = $matches[1];
//        $this->headers['Status-Code'] = $matches[2];
//        $this->headers['Status'] = $matches[2].' '.$matches[3];
        

    }
    
    public function setHeaders($headers) {
      $this->headers = new Headers($headers);
      return $this;
    }
    
    public function setBody($body) {
      $this->body = $body;
      return $this;
    }
    
    /**
     * Returns the response body
     * @return string
    **/
    function __toString() {
        return $this->body;
    }
    
}