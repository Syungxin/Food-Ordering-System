<?php
header('Content-Type: text/plain');

$cmd = 'sudo -u ec2-user /usr/bin/git -C /var/www/html pull origin main 2>&1';
exec($cmd, $output);

echo implode("\n", $output);

?>