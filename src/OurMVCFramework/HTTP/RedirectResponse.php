<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OurMVCFramework\HTTP;

/**
 * Description of RedirectResponse
 *
 * @author renan
 */
class RedirectResponse
{

    public string $to;

    public function __construct(string $to)
    {
        $this->to = $to;
    }

}
