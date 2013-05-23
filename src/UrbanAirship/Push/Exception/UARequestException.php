<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/23/13
 * Time: 8:34 AM
 */

namespace UrbanAirship\Push\Exception;

use Httpful\Response;

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

    public function getRequest()
    {
        return $this->response->request;
    }

    public function getResponse()
    {
        return $this->response;
    }


}