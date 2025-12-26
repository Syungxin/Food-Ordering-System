<?php
    exec('cd /var/www/html && git pull 2>&1', $output);
    echo "<pre>";
    print_r($output);
    echo "</pre>";
?>