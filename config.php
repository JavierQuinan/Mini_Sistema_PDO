<?php
declare(strict_types=1);

const DB_DSN  = 'mysql:host=127.0.0.1;port=3306;dbname=minisistema_pdo;charset=utf8mb4';
const DB_USER = 'root';
const DB_PASS = '';

/** Modo dev */
const APP_DEBUG = true;

function json_out($data, int $status = 200): void {
  http_response_code($status);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  exit;
}
