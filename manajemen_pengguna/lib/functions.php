<?php
function verifyPassword($plain, $hash) {
    return password_verify($plain, $hash);
}
?>
