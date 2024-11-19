<?php
include('lib/phpqrcode/qrlib.php');
$file_name = 'qr/ejemplo.png';
QRcode::png('https://sourceforge.net/projects/phpqrcode/', $file_name, 2, 20, 2);
?>