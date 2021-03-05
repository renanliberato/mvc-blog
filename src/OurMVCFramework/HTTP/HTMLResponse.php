<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OurMVCFramework\HTTP;

/**
 * Description of HTMLResponse
 *
 * @author renan
 */
class HTMLResponse
{

    public string $template;
    public array $data;

    public function __construct(string $template, array $data = [])
    {
        $this->template = $template;
        $this->data = $data;
    }

}
