<?php

namespace controllers;

class ExceptionController extends Controller
{
    public function notFound()
    {
        $this->view('exception/notFound');
    }
}