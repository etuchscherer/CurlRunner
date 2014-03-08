<?php

namespace Tests\CurlRequest;

use Curl\CurlRequest;
use PHPUnit_Framework_TestCase;

/**
 * Description of CurlResponseTest
 *
 * @author papersling
 */
class CurlResponseTest extends PHPUnit_Framework_TestCase {
  
  public $response;
  
  public function setUp() {
    $this->rest = new \Curl\Modules\REST();
    $this->rest->setJSONContent();
    $this->response = $this->rest->get('http://loopback.tuchscherer.me');
  }
  
  public function tearDown() {
    
  }
  
  public function testPass() {
    $this->assertTrue(true);
  }
  //put your code here
}