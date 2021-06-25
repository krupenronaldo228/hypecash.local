<?php

class SITE_Exceptions extends CI_Exceptions
{
    function show_404($page = '', $log_error = TRUE)
    {
        redirect('errors');
    }
}