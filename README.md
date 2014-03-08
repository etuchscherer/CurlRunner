# CurlRunner

An attempt at an easier curl wrapper.

## Useage

To instantiate

    $this->curlRequest = new CurlRequest('www.example.com');
  
To modify the url

    $this->curlRequest = new CurlRequest('www.example.com');
    $this->curlRequest->url('www.new-example.com');

To set the method

    $this->curlRequest = new CurlRequest('www.example.com');
    $this->curlRequest->setMethod('GET');
  
Posting Parameters

    $array = array('foo' => 'bar');
    $this->curlRequest->postFields($array);

Resetting the handler

    $this->curlRequest = new CurlRequest('www.example.com');
    $this->curlRequest->setMethod('GET');
    $this->curlRequest->reset();
    $this->curlRequest->url('somewhere-else.com')->setMethod('POST');

Sending the request

    $this->curlRequest->send();
  
## Modules

### Rest

A module specifically for interacting with restful apis.

To instantiate

    $this->curlRequest = new REST();
    
To set JSON content type

    $this->curlRequest->setJSONContent();

Post to a service

    $this->curlRequest->post('http://example.com', array('foo' => 'bar'));

Delete to a service

    $this->curlRequest->delete('http://example.com', array('foo' => 'bar'));

Patch to a service

    $this->curlRequest->patch('http://example.com', array('foo' => 'bar'));

Put to a service

    $this->curlRequest->put('http://example.com', array('foo' => 'bar'));
    
Head to a service

    $this->curlRequest->head('http://example.com', array('foo' => 'bar'));

Sending the transaction

    $this->curlRequest->send();
