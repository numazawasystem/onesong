<?php
// sql7up2.php（PHP 7.4 前提）

header('Content-Type: application/json; charset=utf-8');

function parse_size_to_bytes($val) {
  $val = trim((string)$val);
  if ($val === '') return 0;
  $last = strtolower($val[strlen($val) - 1]);
  $num = (int)$val;
  switch ($last) {
    case 'g': $num *= 1024;
    case 'm': $num *= 1024;
    case 'k': $num *= 1024;
  }
  return $num;
}

function ulog($msg) {
  // upload3.php側で error_log が専用ファイルに向いていればそこへ出る
  error_log('[upload3] ' . $msg);
}

/**
 * @param resource|null $img
 */
function safe_imagedestroy($img) {
  if (is_resource($img)) {
    imagedestroy($img);
  }
}

$i = 0;
$id = 0;

/** @var resource|null $src_image */
$src_image = null;
/** @var resource|null $dst_image */
$dst_image = null;

try {
  // post_max_size 超過検知（超えると $_POST が空になり得る）
  $contentLen = isset($_SERVER['CONTENT_LENGTH']) ? (int)$_SERVER['CONTENT_LENGTH'] : 0;
  $postMax = parse_size_to_bytes(ini_get('post_max_size'));
  if ($postMax > 0 && $contentLen > $postMax) {
    ulog("POST too large: CONTENT_LENGTH={$contentLen} > post_max_size={$postMax}");
    http_response_code(413);
    echo json_encode(["ok" => false, "error" => "Payload too large"], JSON_UNESCAPED_UNICODE);
    exit;
  }

  $i  = isset($_POST["no"]) ? (int)$_POST["no"] : 0;
  $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;

  if ($i < 1 || $i > 20 || $id <= 0) {
    throw new Exception("bad params: id={$id}, no={$i}");
  }

  // 受け取りキー：現行仕様（canvas01-h ～ canvas20-h）
  $key = sprintf("canvas%02d-h", $i);

  // 将来JSを直してキー固定(canvas)にした場合も拾う
  $dataUrl = isset($_POST["canvas"]) ? (string)$_POST["canvas"] : (isset($_POST[$key]) ? (string)$_POST[$key] : '');

  if ($dataUrl === '') {
    throw new Exception("missing post field: {$key} (or canvas)");
  }

  // data URL -> base64
  $base64 = preg_replace('#^data:image/\w+;base64,#i', '', $dataUrl);
  $base64 = str_replace(["\r", "\n"], '', $base64);

  // strict base64 decode
  $bin = base64_decode($base64, true);
  if ($bin === false) {
    throw new Exception("base64 decode failed (len=" . strlen($base64) . ")");
  }

  // 画像サイズ（data: wrapperは使わない）
  $info = @getimagesizefromstring($bin);
  if ($info === false) {
    throw new Exception("getimagesizefromstring failed");
  }
  $src_w = (int)$info[0];
  $src_h = (int)$info[1];
  if ($src_w <= 0 || $src_h <= 0) {
    throw new Exception("invalid image size: {$src_w}x{$src_h}");
  }

  // 画像生成（失敗時は false が返るので null に寄せる）
  $tmp = @imagecreatefromstring($bin);
  if ($tmp === false) {
    throw new Exception("imagecreatefromstring failed");
  }
  $src_image = $tmp; // resource

  $tmp2 = @imagecreatetruecolor(300, 300);
  if ($tmp2 === false) {
    throw new Exception("imagecreatetruecolor failed");
  }
  $dst_image = $tmp2; // resource

  // 300x300にフィット（余白付き）
  if ($src_h > $src_w) {
    $tate = 300;
    $yoko = ($tate * $src_w) / $src_h;
    $tateC = 0;
    $yokoC = (300 - $yoko) / 2;
  } else {
    $yoko = 300;
    $tate = ($yoko * $src_h) / $src_w;
    $tateC = (300 - $tate) / 2;
    $yokoC = 0;
  }

  $ok = @imagecopyresampled(
    $dst_image, $src_image,
    (int)$yokoC, (int)$tateC,
    0, 0,
    (int)$yoko, (int)$tate,
    $src_w, $src_h
  );
  if (!$ok) {
    throw new Exception("imagecopyresampled failed");
  }

  // ファイル名生成（重複チェック）: 無限ループ回避のため上限
  $filename = '';
  for ($try = 0; $try < 20; $try++) {
    $candidate = date("Ymd-His") . "-" . makeRandStr(10);
    if (sql8($candidate) <= 0) {
      $filename = $candidate;
      break;
    }
  }
  if ($filename === '') {
    throw new Exception("failed to generate unique filename");
  }

  // 保存先
  $dirImg = __DIR__ . '/../images/photoimg';
  $dirCth = __DIR__ . '/../images/photocth';
  if (!is_dir($dirImg) && !@mkdir($dirImg, 0775, true)) {
    throw new Exception("mkdir failed: photoimg");
  }
  if (!is_dir($dirCth) && !@mkdir($dirCth, 0775, true)) {
    throw new Exception("mkdir failed: photocth");
  }

  $pathImg = $dirImg . '/' . $filename . '.jpg';
  $pathCth = $dirCth . '/' . $filename . '.jpg';

  // オリジナル保存（LOCK_EXで競合耐性）
  if (@file_put_contents($pathImg, $bin, LOCK_EX) === false) {
    throw new Exception("file_put_contents failed: {$pathImg}");
  }

  // サムネ保存（品質 85）
  if (!@imagejpeg($dst_image, $pathCth, 85)) {
    @unlink($pathImg);
    throw new Exception("imagejpeg failed: {$pathCth}");
  }

  // DB登録は最後（成功したら）
  // ※できれば photo(a_id,no) に UNIQUE を貼って upsert すると更に堅い
  $stmt = $db->prepare("INSERT INTO photo (a_id, no, data) VALUES (?, ?, ?)");
  $stmt->execute([$id, $i, $filename]);

  echo json_encode([
    "ok"   => true,
    "id"   => $id,
    "no"   => $i,
    "file" => $filename
  ], JSON_UNESCAPED_UNICODE);
  exit;

} catch (Throwable $e) {
  // 失敗を必ずログへ
  $cl = isset($_SERVER['CONTENT_LENGTH']) ? (int)$_SERVER['CONTENT_LENGTH'] : 0;
  ulog("FAIL id=" . ($id ?: 'NA') . " no=" . ($i ?: 'NA') . " CL={$cl} : " . $e->getMessage());

  http_response_code(400);
  echo json_encode([
    "ok"    => false,
    "id"    => $id ?: null,
    "no"    => $i ?: null,
    "error" => $e->getMessage()
  ], JSON_UNESCAPED_UNICODE);
  exit;

} finally {
  safe_imagedestroy($src_image);
  safe_imagedestroy($dst_image);
}
?>