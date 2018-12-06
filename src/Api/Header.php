<?php

namespace Kingsquare\Wercker\Api;

class Header
{
    /**
     * @var string
     */
    protected $header;

    /**
     * @var string
     */
    protected $value;

    /**
     * Header constructor.
     * @param string $header
     * @param string $value
     */
    public function __construct($header, $value)
    {
        $this->header = $header;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function get()
    {
        return $this->header . ': ' . $this->value . PHP_EOL;
    }
}
