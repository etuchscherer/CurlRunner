<?php

namespace Tests\CurlRequest;

use Curl\CurlRequest;
use PHPUnit_Framework_TestCase;

class CurlRequestTest extends PHPUnit_Framework_TestCase {
  
  public $curlRequest;
  
  public function setUp() {
    $this->curlRequest = new CurlRequest('www.example.com');
  }
  
  public function tearDown() {
    $this->curlRequest = null;
  }

  public function testCanInstansiate() {
    $this->assertInstanceOf('\Curl\CurlRequest', $this->curlRequest);
  }
  
  public function testIsInitialized() {
    $this->assertTrue($this->curlRequest->isInitialized());
  }
  
  public function testClearingErrorsWorks() {
    $this->curlRequest->clearErrors();
    $this->assertFalse($this->curlRequest->hasErrors());
  }
  
  public function testThrowUnitializedError() {
    $this->setExpectedException('\Curl\CurlException');
    $this->curlRequest->throwUninitializedException('test');
  }
  
  public function testCanNotSendAfterReset() {
    $this->curlRequest->reset();
    $this->setExpectedException('\Curl\CurlException');
    $this->curlRequest->send();
  }
  
  public function testCanResetAndSend() {
    $this->curlRequest->reset();
    $sent = $this->curlRequest->url('www.example.com')->setMethod('GET')->send();
    $this->assertTrue($sent);
  }
  
  public function testLastStatusCode() {
    $sent = $this->curlRequest->setMethod('GET')->send();
    $this->assertTrue($sent);
    $this->assertEquals($this->curlRequest->status(), 200);
  }
  
  public function setCanLoadPostParams() {
    $array = array('foo' => 'bar');
    $set = $this->curlRequest->postFields($array);
    $this->assertTrue($set);
    $this->assertEquals($this->curlRequest->postFields(), $array);
  }
}