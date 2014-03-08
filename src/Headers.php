<?php

namespace Curl;

/**
 * Description of CurlHeaders
 *
 * @author papersling
 */
class Headers {
  
  /**
   *
   * @var integer
   */
  public $code;
  
  /**
   *
   * @var array
   */
  public $headers;
  
  /**
   *
   * @var string
   */
  public $raw;
  
  /**
   *
   * @var integer
   */
  public $status;

  /**
   *
   * @var string
   */
  public $version;
  
  public function __construct($string) {
    $this->raw = $string;
    $this->parse($string);
  }
  
  public function parse() {
    $this->headers = explode("\r\n", str_replace("\r\n\r\n", '', $this->raw));
    
    # Extract the version and status from the first header
    if (is_array($this->headers)) {
      $status_hdr = array_shift($this->headers);

      $pattern = '#HTTP/\d\.\d\s(\d\d\d)\s.*#';
      preg_match($pattern, $status_hdr, $match);
      
      $this->status = $match;
    }
  }
}