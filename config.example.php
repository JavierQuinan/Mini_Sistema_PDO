<?php
declare(strict_types=1);

/**
 * Archivo de configuración de ejemplo
 * 
 * Copia este archivo como config.php y ajusta los valores
 * según tu entorno de desarrollo o producción.
 */

// Configuración de base de datos
const DB_DSN  = 'mysql:host=127.0.0.1;port=3306;dbname=minisistema_pdo;charset=utf8mb4';
const DB_USER = 'root';
const DB_PASS = '';

// Modo de depuración (cambiar a false en producción)
const APP_DEBUG = true;

// CORS - Configurar según necesidad
const CORS_ORIGIN = '*'; // Cambiar a dominio específico en producción

/**
 * Función helper para respuestas JSON
 */
function json_out($data, int $status = 200): void {
  http_response_code($status);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  exit;
}
