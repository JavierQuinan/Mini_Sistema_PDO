<?php
declare(strict_types=1);

/**
 * Script de configuración para SQLite
 * Crea la base de datos SQLite y la tabla items
 */

$dbPath = __DIR__ . '/database.sqlite';

try {
  // Crear conexión SQLite
  $pdo = new PDO("sqlite:$dbPath");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  // Crear tabla items
  $sql = "CREATE TABLE IF NOT EXISTS items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre VARCHAR(120) NOT NULL,
    precio DECIMAL(10,2) NOT NULL DEFAULT 0,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  )";
  
  $pdo->exec($sql);
  
  echo "✅ Base de datos SQLite creada exitosamente en: $dbPath\n";
  echo "✅ Tabla 'items' creada correctamente\n\n";
  
  // Insertar datos de ejemplo
  echo "📝 Insertando datos de ejemplo...\n";
  $stmt = $pdo->prepare("INSERT INTO items (nombre, precio) VALUES (?, ?)");
  
  $ejemplos = [
    ['Laptop HP', 1200.00],
    ['Mouse Logitech', 25.50],
    ['Teclado Mecánico', 89.99],
    ['Monitor Dell 24"', 350.00],
    ['Webcam HD', 45.00]
  ];
  
  foreach ($ejemplos as $item) {
    $stmt->execute($item);
  }
  
  echo "✅ " . count($ejemplos) . " items de ejemplo insertados\n\n";
  
  // Verificar inserción
  $result = $pdo->query("SELECT COUNT(*) as total FROM items")->fetch();
  echo "📊 Total de items en la base de datos: {$result['total']}\n";
  
  echo "\n🎉 ¡Configuración completada! Ahora puedes usar el sistema.\n";
  echo "💡 Recuerda actualizar config.php para usar SQLite.\n";
  
} catch (PDOException $e) {
  echo "❌ Error: " . $e->getMessage() . "\n";
  exit(1);
}
