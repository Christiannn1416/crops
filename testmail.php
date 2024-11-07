<?php
require 'sistema.class.php';

$app = new Sistema;
$app->sendMail('20030835@itcelaya.edu.mx', 'Hola lincefest', 'Hola lincefest');
