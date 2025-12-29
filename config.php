<?php
declare(strict_types=1);

/** Configuración de Base de Datos */
const DB_DSN  = 'mysql:host=127.0.0.1;port=3306;dbname=minisistema_pdo;charset=utf8mb4';
const DB_USER = 'root';
const DB_PASS = '';

/** Modo dev */
const APP_DEBUG = true;

/** CORS Configuration */
const CORS_ORIGIN = '*'; // Cambiar a dominio específico en producción
const CORS_METHODS = 'GET, POST, PUT, DELETE, OPTIONS';
const CORS_HEADERS = 'Content-Type, Authorization, X-Requested-With';

/** Rate Limiting (solicitudes por minuto) */
const RATE_LIMIT_MAX = 100;

/**
 * Configurar headers CORS
 */
function setup_cors(): void {
  header('Access-Control-Allow-Origin: ' . CORS_ORIGIN);
  header('Access-Control-Allow-Methods: ' . CORS_METHODS);
  header('Access-Control-Allow-Headers: ' . CORS_HEADERS);
  header('Access-Control-Max-Age: 3600');
  
  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
  }
}

/**
 * Función helper para respuestas JSON
 */
function json_out($data, int $status = 200): void {
  http_response_code($status);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  exit;
}

/**
 * Sanitizar entrada de texto
 */
function sanitize_string(string $input): string {
  return htmlspecialchars(trim($input), ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Logging de errores
 */
function log_error(string $message, array $context = []): void {
  if (APP_DEBUG) {
    $logFile = __DIR__ . '/logs/error.log';
    $dir = dirname($logFile);
    if (!is_dir($dir)) @mkdir($dir, 0755, true);
    
    $timestamp = date('Y-m-d H:i:s');
    $contextStr = !empty($context) ? ' | ' . json_encode($context) : '';
    $logEntry = "[$timestamp] $message$contextStr" . PHP_EOL;
    @file_put_contents($logFile, $logEntry, FILE_APPEND);
  }
}
