<?php
$smtp = new Mailer();
$getSMTP = $smtp->getSMTP(1);

$settings = new Settings;
$getSettings = $settings->getSettings(1);

$smtp_types = ["None", "SSL", "TLS"];
