<?php

namespace Helpers;

class ViewHelper
{
    public static function title($title)
    {
        return "<script>
                const title = document.querySelector('#page-title');
                title.innerText = '$title';
                document.title = '$title';
                </script>";
    }

    public static function toast($title ,$message, $type = 'success',$duration=3000)
    {
        $icons = [
        'success' => 'fa-check-circle',
                'error' => 'fa-solid fa-circle-exclamation',
                'info'=> 'fa-circle-info',
                'warning'=> 'fa-solid fa-circle-exclamation',
            ];
        $iconType = $icons[$type];
        return " 
        <div id='toast'>
</div>
<script > 
        const main = document.querySelector('#toast') 
        
        if (main) {
            const toast = document.createElement('div')
            toast.classList.add('toast', `toast-$type`);
            const autoRemoveId = setTimeout(function () {
                main.removeChild(toast)
            }, $duration + 1000)
            toast.onclick = function (e) {
                if (e.target.closest('.toast_close')) {
                    main.removeChild(toast)
                    clearTimeout(autoRemoveId)
                }
            }  
            toast.innerHTML = `
                <div class='toast_icon'>
                <i class='fas fa-sharp $iconType'></i>
                </div>
                <div class='toast_message'>
                    <h3 class='toast_title''>$title</h3>
                    <p class='toast_msg''>$message</p>
                </div>
                <div class='toast_close''>x</div>
            ` 
            main.appendChild(toast)
    }
</script>";
    }
}