<?php
//    Copyright 2012 Urban Airship
//
//    Licensed under the Apache License, Version 2.0 (the "License");
//    you may not use this file except in compliance with the License.
//    You may obtain a copy of the License at
//
//    http://www.apache.org/licenses/LICENSE-2.0
//
//    Unless required by applicable law or agreed to in writing, software
//    distributed under the License is distributed on an "AS IS" BASIS,
//    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
//    See the License for the specific language governing permissions and
//    limitations under the License.

namespace UrbanAirship\Push\Response;

/**
 * Returned for queries against the device token list API endpoint. This response
 * handles multi page responses from the UA server. The API automatically pages
 * a response at 2000 tokens. When that limit is hit, this response will
 * automatically download the next page and continue iterating over device
 * tokens. This could potentially be a long running operation.
 *
 * Class UADeviceTokenListResponse
 * @package UrbanAirship\Push\Response
 */
class UADeviceTokenListResponse extends UAResponse implements \Iterator{

    const NEXT_PAGE_KEY = "next_page";
    const DEVICE_TOKENS_KEY = "device_tokens";
    const DEVICE_TOKENS_COUNT_KEY = "device_tokens_count";
    const ACTIVE_DEVICE_TOKENS_COUNT_KEY = "active_device_tokens_count";

    /**
     * @var int Position for Iterator interface
     */
    private $position;

    /**
     * @var object Current page of multi page download
     */
    private $page;

    /**
     * Return the current page of results
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    public function __construct($response)
    {
        parent::__construct($response);
        $this->position = 0;
        $this->page = $response->body;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        $tokens = $this->page->{self::DEVICE_TOKENS_KEY};
        return $tokens[$this->position];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        $tokenCount = count($this->page->{self::DEVICE_TOKENS_KEY});
        // Moving through existing page
        if ($this->position < $tokenCount){
            return true;
        }
        // Check and load another page if it exists
        if($this->position >= $tokenCount){
            $nextPage = $this->loadNextPage($this->page);
            if (is_null($nextPage)){
                // TODO info about no more pages
                return false;
            }
            // Only replace the page if a new one came down
            $this->page = $nextPage;
            // Reset counter if a new page was downloaded.
            $this->position = 0;
            return true;
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Takes the current page and retrieves the next
     * page of results. Returns
     * @param $page object Object representing a single page result
     * @return null
     */
    private function loadNextPage($page)
    {
        if (!isset($page->{self::NEXT_PAGE_KEY})){
            return null;
        }
        else {
            $request = $this->response->request;
            $request->uri($page->{self::NEXT_PAGE_KEY});
            $response = $request->send();
            if ($response->hasErrors()){
                // TODO log error info
                return null;
            }
            else {
                return $response->body;
            }
        }
    }


}