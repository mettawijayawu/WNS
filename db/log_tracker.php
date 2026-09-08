<?php
function log_activity($activity = '', $data = []) {
$log_dir = __DIR__ . '/../log';
    $file = $log_dir . '/log_user.txt';

    // Pastikan folder log ada
    if (!is_dir($log_dir)) {
        mkdir($log_dir, 0777, true);
    }

    $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $method = $_SERVER['REQUEST_METHOD'] ?? '';
    $datetime = date('Y-m-d H:i:s');

    $log = "[$datetime] IP: $ip | METHOD: $method | URI: $uri";

    if ($activity) {
        $log .= " | ACTION: $activity";
    }

    if (!empty($data)) {
        $log .= " | DATA: " . json_encode($data);
    }

    $log .= " | AGENT: $agent\n";

    file_put_contents($file, $log, FILE_APPEND);
}
?>
