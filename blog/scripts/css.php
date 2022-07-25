<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css">

<?php 
    $query = "SELECT * FROM tbl_theme WHERE id='2'";
    $theme = $db->select($query);
    while ($result = $theme->fetch_assoc()) {
        if ($result['theme'] == 'default') {
            ?>
            <link rel="stylesheet" href="theme/default.css">
            <?php 
        }
        elseif($result['theme'] == 'green') {
            ?>
            <link rel="stylesheet" href="theme/green.css">
            <?php
        }
        elseif ($result['theme'] == 'red') {
            ?>
            <link rel="stylesheet" href="theme/red.css">
            <?php
        }
        ?>
        <?php 
    }

?>