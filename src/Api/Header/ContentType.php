<?php

namespace Kingsquare\Wercker\Api\Header;

/**
 * Class ContentType
 * @package Kingsquare\Wercker\Api\Header
 */
class ContentType extends \Kingsquare\Wercker\Api\Header
{
    /**
     * ContentType constructor.
     *
     * @param string $contentType
     */
    public function __construct($contentType)
    {
        parent::__construct('Content-Type', $contentType);
    }
}
