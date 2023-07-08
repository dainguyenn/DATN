<?php

namespace Helpers;

class WindowHelper
{
    public static function location($from)
    {
        return "<script>window.location.href = '$from'</script>";
    }
}