<?php
require_once('../load.php');
if (!$session->logout()) {
    redirect('../../', false);
}
?>
