<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

namespace UrbanAirship\Devices;

abstract class DeviceList implements \Iterator
{

    const NEXT_PAGE_KEY = "next_page";
    const MEMBER_KEY = null;

    /* must be replaced in concrete class */
    const LIST_URL = null;

    //
    /**
     * @var int Position for Iterator interface
     */
    private $position;

    /**
     * @var object Current page of multi page download
     */
    private $page;

    function __construct($airship, $limit=null)
    {
        $this->airship = $airship;
        $this->position = 0;
        if ($limit) {
            $this->start_url = $airship->buildUrl(static::LIST_URL, array("limit" => $limit));
        } else {
            $this->start_url = $airship->buildUrl(static::LIST_URL);
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        $tokens = $this->page->{static::MEMBER_KEY};
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
        if (isset($this->page)) {
            $tokenCount = count($this->page->{static::MEMBER_KEY});
            // Moving through existing page
            if ($this->position < $tokenCount){
                return true;
            }
        }

        // Check and load another page if it exists
        if ($this->loadNextPage()) {
            $tokenCount = count($this->page->{static::MEMBER_KEY});
            // If the next page has more tokens, keep going
            if ($tokenCount > 0){
                return true;
            }            
        }

        // No more data
        return false;
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
     * @return bool
     */
    private function loadNextPage()
    {
        if (!isset($this->page)) {
            $next = $this->start_url;
        } elseif (isset($this->page->{static::NEXT_PAGE_KEY})) {
            $next = $this->page->{static::NEXT_PAGE_KEY};
        } else {
            return false;
        }

        $response = $this->airship->request("GET", null, $next, null, 3);
        $this->page = json_decode($response->raw_body);
        $this->position = 0;
        return true;
    }
}
