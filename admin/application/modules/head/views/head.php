<head>
    <meta charset="UTF-8">
    <title><?php echo @$page_titulo ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato:400, 700" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo str_replace('admin', '', base_url('assets/images/logo.png'))  ?>" type="image/png">

    <?php 
    if(@($headcss)): 
        foreach($headcss as $link):
            echo '<link rel="stylesheet" type="text/css" href="'.($link).'">'; 
        endforeach; 
    endif;

    if(@($css)):
        foreach($css as $link): 
            echo '<link rel="stylesheet" type="text/css" href="'.($link).'">'; 
        endforeach; 
    endif;  
    ?>
</head>