<?php

function redirect_to($location)
{
    if($location != null)
    {
        echo "<script>location.href='{$location}'</script>";
        exit;
    }
}

function include_layout_template($template)
{
    include(SITE_ROOT.'public_html'.DS.'layouts'.DS.$template);
}



?>