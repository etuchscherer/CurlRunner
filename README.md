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
  
