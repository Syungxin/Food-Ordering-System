<?php
// Execute deployment
$output = [];
exec('cd /var/www/html && git pull origin main 2>&1', $output);

// Return output
header('Content-Type: text/plain');
echo implode("\n", $output);
?>