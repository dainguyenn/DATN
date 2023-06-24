<?php

namespace Helpers;

class ViewHelper
{
    public static function title($title)
    {
        return "<script>
                const title = document.querySelector('#page-title');
                title.innerText = '$title';
                </script>";
    }
}