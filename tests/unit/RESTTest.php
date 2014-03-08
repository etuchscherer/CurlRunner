<?php

namespace Tests\Modules;

use PHPUnit_Framework_TestCase;
use Curl\Modules\REST;
use Curl\HTTP;

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
    $sent = $this->curlRequest->post('http://example.com', array('foo' => 'bar'));
    $this->assertTrue($sent);
  }
  
  public function testCanDeleteDataToServer() {
    $sent = $this->curlRequest->delete('http://example.com', array('foo' => 'baz'));
    $this->assertTrue($sent);
  }
  
  public function testCanPatchDataToServer() {
    $sent = $this->curlRequest->patch('http://example.com', array('bar' => 'bell'));
    $this->assertTrue($sent);
  }
  
  public function testCanHeadDataToServer() {
    $sent = $this->curlRequest->head('http://example.com', array('bar' => 'bell'));
    $this->assertTrue($sent);
  }
  
  public function testCanPutDataToServer() {
    $sent = $this->curlRequest->put('http://example.com', array('bar' => 'bell'));
    $this->assertTrue($sent);
  }
  
  public function testCanSetJsonContentType() {
    $this->curlRequest->setJSONContent();
    $this->curlRequest->get('http://example.com');
    $this->assertEquals('Content-Type: application/json; charset=utf-8', $this->curlRequest->info(CURLINFO_CONTENT_TYPE));
  }
  
  
}