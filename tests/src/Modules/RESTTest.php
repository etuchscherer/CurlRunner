<?php

namespace Tests\Modules;

use PHPUnit_Framework_TestCase;
use Curl\Modules\REST;

/**
 * Description of RESTTest
 *
 * @author eric
 */
class RESTTest extends PHPUnit_Framework_TestCase {
  
  public $curlRequest;
  
  public function setUp() {
    $this->curlRequest = new REST();
  }
  
  public function tearDown() {
    $this->curlRequest = null;
  }
  
  public function testPass() {
    $this->assertTrue(true);
  }
  
  public function testCanPostDataToServer() {
    $sent = $this->curlRequest->post('http://loopback.local.com', array('foo' => 'bar'));
    $this->assertTrue($sent);
  }
  
  public function testCanDeleteDataToServer() {
    $sent = $this->curlRequest->delete('http://loopback.local.com', array('foo' => 'baz'));
    $this->assertTrue($sent);
  }
  
  public function testCanPatchDataToServer() {
    $sent = $this->curlRequest->patch('http://loopback.local.com', array('bar' => 'bell'));
    $this->assertTrue($sent);
  }
  
  public function testCanHeadDataToServer() {
    $sent = $this->curlRequest->head('http://loopback.local.com', array('bar' => 'bell'));
    $this->assertTrue($sent);
  }
  
  public function testCanPutDataToServer() {
    $sent = $this->curlRequest->put('http://loopback.local.com', array('bar' => 'bell'));
    $this->assertTrue($sent);
  }
  
  
}