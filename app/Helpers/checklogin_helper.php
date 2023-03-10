<?php
function checklogin()
{
    if (isset($_SESSION['username'])) {
        return true;
    } else {
        return false;
    }
}
