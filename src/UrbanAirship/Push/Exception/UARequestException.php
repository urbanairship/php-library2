<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/23/13
 * Time: 8:34 AM
 */

namespace UrbanAirship\Push\Exception;

use Httpful\Response;

/**
 * Thrown for a non 2** server response from Urban Airship. Contains the
 * original http request, and the response.  
 * Class UARequestException
 * @package UrbanAirship\Push\Exception
 */
class UARequestException extends \Exception {

    private $response;

    /**
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        parent::__construct($response->body, $response->code);
        $this->response = $response;
    }

    /**
     * Get the Httpful/Request that was made.
     * @return \Httpful\Request
     */
    public function getRequest()
    {
        return $this->response->request;
    }

    /**
     * Get the Httpful\Response that caused the exception.
     * @return \Httpful\Response
     */
    public function getResponse()
    {
        return $this->response;
    }


}