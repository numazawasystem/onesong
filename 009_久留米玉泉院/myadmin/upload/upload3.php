<?php
// upload3.php
// ※余計なecho/空白を入れない（JSON出力はsql7up2.php側）

session_start();

// ---- ログ設定（書けなければPHP標準ログへ）----
$logDir = __DIR__ . '/../logs';
if (!is_dir($logDir)) { @mkdir($logDir, 0775, true); }
$logFile = $logDir . '/upload3.log';

ini_set('log_errors', '1');
ini_set('display_errors', '0');
@ini_set('error_log', $logFile);

// ---- includes ----
include("../text/sqlheader.php");
include("../function/str.php");
include("../sql/sql8.php");
include("../sql/sql7up2.php");
?>