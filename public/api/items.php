<?php
declare(strict_types=1);

// Forzar JSON SIEMPRE (nada de <br/>)
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '0');
set_error_handler(function($sev, $msg, $file, $line){
  http_response_code(500);
  echo json_encode(['ok'=>false,'error'=>$msg,'file'=>$file,'line'=>$line], JSON_UNESCAPED_UNICODE);
  exit;
});

// ✅ subir dos niveles porque estamos en /public/api
require_once __DIR__ . '/../../ItemModel.php';

try {
  $items  = new ItemModel();
  $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
  $action = $_GET['action'] ?? $_POST['action'] ?? null;
  $id     = isset($_GET['id']) ? (int)$_GET['id'] : (isset($_POST['id']) ? (int)$_POST['id'] : null);

  switch ("$method:$action") {
    case 'GET:listar':
      $limit  = (int)($_GET['limit']  ?? 50);
      $offset = (int)($_GET['offset'] ?? 0);
      echo json_encode(['ok'=>true,'data'=>$items->listar($limit,$offset)], JSON_UNESCAPED_UNICODE);
      break;

    case 'GET:obtener':
      if (!$id) { http_response_code(400); echo json_encode(['ok'=>false,'error'=>'id requerido']); break; }
      $row = $items->obtener($id);
      if ($row) echo json_encode(['ok'=>true,'data'=>$row], JSON_UNESCAPED_UNICODE);
      else { http_response_code(404); echo json_encode(['ok'=>false,'error'=>'no encontrado']); }
      break;

    case 'POST:crear':
      $input = $_POST;
      if (empty($input)) { $raw = file_get_contents('php://input'); if ($raw) $input = json_decode($raw, true) ?? []; }
      $nombre = $input['nombre'] ?? '';
      $precio = (float)($input['precio'] ?? 0);
      $row = $items->crear($nombre, $precio);
      http_response_code(201);
      echo json_encode(['ok'=>true,'data'=>$row], JSON_UNESCAPED_UNICODE);
      break;

    case 'POST:actualizar':
      if (!$id) { http_response_code(400); echo json_encode(['ok'=>false,'error'=>'id requerido']); break; }
      $raw   = file_get_contents('php://input');
      $input = $_POST ?: (json_decode($raw, true) ?? []);
      $nombre = $input['nombre'] ?? null;
      $precio = array_key_exists('precio',$input) ? (float)$input['precio'] : null;
      $row = $items->actualizar($id, $nombre, $precio);
      if ($row) echo json_encode(['ok'=>true,'data'=>$row], JSON_UNESCAPED_UNICODE);
      else { http_response_code(404); echo json_encode(['ok'=>false,'error'=>'no encontrado']); }
      break;

    case 'POST:eliminar':
      if (!$id) { http_response_code(400); echo json_encode(['ok'=>false,'error'=>'id requerido']); break; }
      $ok = $items->eliminar($id);
      if ($ok) echo json_encode(['ok'=>true,'deleted'=>$id], JSON_UNESCAPED_UNICODE);
      else { http_response_code(404); echo json_encode(['ok'=>false,'error'=>'no encontrado']); }
      break;

    default:
      http_response_code(404);
      echo json_encode([
        'ok'=>false,
        'error'=>'Ruta no encontrada',
        'help'=>[
          'GET  /api/items.php?action=listar&limit=50&offset=0',
          'GET  /api/items.php?action=obtener&id=1',
          'POST /api/items.php?action=crear {nombre, precio}',
          'POST /api/items.php?action=actualizar&id=1 {nombre?, precio?}',
          'POST /api/items.php?action=eliminar&id=1'
        ]
      ], JSON_UNESCAPED_UNICODE);
  }
} catch (Throwable $e) {
  http_response_code(500);
  echo json_encode(['ok'=>false,'error'=>$e->getMessage()], JSON_UNESCAPED_UNICODE);
}
