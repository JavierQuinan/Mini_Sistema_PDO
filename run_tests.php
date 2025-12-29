<?php
declare(strict_types=1);

/**
 * Suite de Tests para Mini Sistema PDO
 * Tests básicos para validar funcionamiento CRUD
 */

require_once __DIR__ . '/ItemModel.php';

class TestRunner {
  private int $passed = 0;
  private int $failed = 0;
  private array $errors = [];
  
  public function assert(bool $condition, string $message): void {
    if ($condition) {
      $this->passed++;
      echo "✅ PASS: $message\n";
    } else {
      $this->failed++;
      $this->errors[] = $message;
      echo "❌ FAIL: $message\n";
    }
  }
  
  public function assertEquals($expected, $actual, string $message): void {
    $this->assert($expected === $actual, "$message (esperado: " . json_encode($expected) . ", actual: " . json_encode($actual) . ")");
  }
  
  public function assertTrue(bool $value, string $message): void {
    $this->assert($value === true, $message);
  }
  
  public function assertFalse(bool $value, string $message): void {
    $this->assert($value === false, $message);
  }
  
  public function assertNotNull($value, string $message): void {
    $this->assert($value !== null, $message);
  }
  
  public function summary(): void {
    echo "\n" . str_repeat("=", 60) . "\n";
    echo "📊 RESUMEN DE TESTS\n";
    echo str_repeat("=", 60) . "\n";
    echo "✅ Tests pasados: {$this->passed}\n";
    echo "❌ Tests fallidos: {$this->failed}\n";
    echo "📈 Total: " . ($this->passed + $this->failed) . "\n";
    
    if ($this->failed > 0) {
      echo "\n⚠️ Errores encontrados:\n";
      foreach ($this->errors as $i => $error) {
        echo ($i + 1) . ". $error\n";
      }
      exit(1);
    } else {
      echo "\n🎉 ¡Todos los tests pasaron exitosamente!\n";
      exit(0);
    }
  }
}

echo "🧪 Iniciando Suite de Tests - Mini Sistema PDO\n";
echo str_repeat("=", 60) . "\n\n";

$test = new TestRunner();
$model = new ItemModel();

// Test 1: Listar items
echo "📋 Test 1: Listar Items\n";
$items = $model->listar();
$test->assertTrue(is_array($items), "Listar debe retornar un array");
$test->assertTrue(count($items) > 0, "Debe haber al menos un item en la BD");
echo "\n";

// Test 2: Crear item
echo "➕ Test 2: Crear Item\n";
try {
  $nuevoItem = $model->crear('Test Product', 99.99);
  $test->assertNotNull($nuevoItem, "Crear debe retornar el item creado");
  $test->assertEquals('Test Product', $nuevoItem['nombre'], "El nombre debe coincidir");
  $test->assertEquals(99.99, (float)$nuevoItem['precio'], "El precio debe coincidir");
  $testId = (int)$nuevoItem['id'];
  echo "\n";
} catch (Exception $e) {
  $test->assert(false, "Error al crear item: " . $e->getMessage());
  $testId = null;
}

// Test 3: Obtener item
echo "🔍 Test 3: Obtener Item\n";
if ($testId) {
  $item = $model->obtener($testId);
  $test->assertNotNull($item, "Obtener debe retornar el item");
  $test->assertEquals($testId, (int)$item['id'], "El ID debe coincidir");
  echo "\n";
}

// Test 4: Actualizar item
echo "✏️ Test 4: Actualizar Item\n";
if ($testId) {
  try {
    $actualizado = $model->actualizar($testId, 'Test Product Updated', 149.99);
    $test->assertNotNull($actualizado, "Actualizar debe retornar el item actualizado");
    $test->assertEquals('Test Product Updated', $actualizado['nombre'], "El nombre debe estar actualizado");
    $test->assertEquals(149.99, (float)$actualizado['precio'], "El precio debe estar actualizado");
    echo "\n";
  } catch (Exception $e) {
    $test->assert(false, "Error al actualizar item: " . $e->getMessage());
  }
}

// Test 5: Validaciones
echo "🛡️ Test 5: Validaciones\n";
try {
  $model->crear('', 10.00);
  $test->assert(false, "Debe lanzar excepción con nombre vacío");
} catch (InvalidArgumentException $e) {
  $test->assertTrue(str_contains($e->getMessage(), 'obligatorio'), "Debe validar nombre vacío");
}

try {
  $model->crear('Test', -10.00);
  $test->assert(false, "Debe lanzar excepción con precio negativo");
} catch (InvalidArgumentException $e) {
  $test->assertTrue(str_contains($e->getMessage(), 'negativo'), "Debe validar precio negativo");
}

try {
  $nombreLargo = str_repeat('A', 121);
  $model->crear($nombreLargo, 10.00);
  $test->assert(false, "Debe lanzar excepción con nombre muy largo");
} catch (InvalidArgumentException $e) {
  $test->assertTrue(str_contains($e->getMessage(), '120'), "Debe validar longitud máxima");
}

try {
  $model->crear('Test', 9999999.99);
  $test->assert(false, "Debe lanzar excepción con precio muy alto");
} catch (InvalidArgumentException $e) {
  $test->assertTrue(str_contains($e->getMessage(), 'límite'), "Debe validar precio máximo");
}
echo "\n";

// Test 6: Eliminar item
echo "🗑️ Test 6: Eliminar Item\n";
if ($testId) {
  $eliminado = $model->eliminar($testId);
  $test->assertTrue($eliminado, "Eliminar debe retornar true");
  $itemEliminado = $model->obtener($testId);
  $test->assertEquals(null, $itemEliminado, "El item no debe existir después de eliminar");
  echo "\n";
}

// Test 7: Paginación
echo "📄 Test 7: Paginación\n";
$items5 = $model->listar(5, 0);
$test->assertTrue(count($items5) <= 5, "Debe respetar el límite de items");
$items2 = $model->listar(2, 0);
$test->assertTrue(count($items2) <= 2, "Debe respetar límite de 2 items");
echo "\n";

// Test 8: Sanitización XSS
echo "🔒 Test 8: Sanitización XSS\n";
try {
  $xssTest = $model->crear('<script>alert("XSS")</script>', 50.00);
  $test->assertFalse(str_contains($xssTest['nombre'], '<script>'), "Debe sanitizar tags HTML");
  $test->assertTrue(str_contains($xssTest['nombre'], '&lt;script&gt;'), "Debe escapar caracteres especiales");
  $model->eliminar((int)$xssTest['id']); // Limpiar
  echo "\n";
} catch (Exception $e) {
  $test->assert(false, "Error en test XSS: " . $e->getMessage());
}

$test->summary();
