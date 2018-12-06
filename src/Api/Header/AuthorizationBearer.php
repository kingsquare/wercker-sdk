<?php

namespace Kingsquare\Wercker\Api\Header;

/**
 * Class AuthorizationBearer
 * @package Kingsquare\Wercker\Api\Header
 */
class AuthorizationBearer extends \Kingsquare\Wercker\Api\Header
{

    /**
     * AuthorizationBearer constructor.
     *
     * @param string $token
     */
    public function __construct($token)
    {
        parent::__construct('Authorization', 'Bearer ' . $token);
    }
}
