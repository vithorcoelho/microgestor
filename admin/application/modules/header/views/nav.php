<div class="ks-navbar-menu">

<?php
foreach ($config_header['nav'] as $titulo => $url)
{
    if($url == base_url($this->uri->segment(1)))
    {
        $active = 'ks-active';
    }
    else
    {
        $active = '';
    }

    if(!is_array($url))
    {
        echo '<a  class="nav-item nav-link link-load '.$active.'" href="'.$url.'">'.$titulo.'</a>';
    }
    else
    {
        echo '<div class="nav-item dropdown '.$active.' ">';
        echo '<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">'.$titulo.'</a>';
        echo '<div class="dropdown-menu ks-info" aria-labelledby="Preview">';
            foreach ($url as $subtitulo => $suburl)
            {
                if($suburl == base_url($this->uri->segment(1)))
                {
                    $active = 'ks-active';

                    echo '<a class="dropdown-item link-load '.$active.'" href="'.$suburl.'">'.$subtitulo.'</a>';
                }
                else
                {
                    echo '<a class="dropdown-item link-load" href="'.$suburl.'">'.$subtitulo.'</a>';
                }
            }
        echo '</div>';
        echo '</div>';
    }
}
?>
</div>