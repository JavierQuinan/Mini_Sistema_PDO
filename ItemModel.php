<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Database.php';

final class ItemModel {
  private Database $db;

  public function __construct(?Database $db = null) {
    $this->db = $db ?? Database::getInstance();
  }

  public function listar(int $limit = 50, int $offset = 0): array {
    $limit  = max(1, min(200, $limit));
    $offset = max(0, $offset);
    return $this->db->select(
      "SELECT id, nombre, precio, creado_en
       FROM items ORDER BY id DESC LIMIT :limit OFFSET :offset",
      [':limit' => $limit, ':offset' => $offset]
    );
  }

  public function obtener(int $id): ?array {
    $res = $this->db->select(
      "SELECT id, nombre, precio, creado_en FROM items WHERE id = :id",
      [':id' => $id]
    );
    return $res[0] ?? null;
  }

  public function crear(string $nombre, float $precio): array {
    $nombre = trim($nombre);
    if ($nombre === '') throw new \InvalidArgumentException('El nombre es obligatorio');
    if ($precio < 0)  throw new \InvalidArgumentException('El precio no puede ser negativo');

    $this->db->execStmt(
      "INSERT INTO items (nombre, precio) VALUES (:n, :p)",
      [':n' => $nombre, ':p' => $precio]
    );
    $id = (int)$this->db->lastId();
    return $this->obtener($id) ?? ['id' => $id, 'nombre' => $nombre, 'precio' => $precio];
  }

  public function actualizar(int $id, ?string $nombre = null, ?float $precio = null): ?array {
    $item = $this->obtener($id);
    if (!$item) return null;

    $nombre = $nombre !== null ? trim($nombre) : $item['nombre'];
    $precio = $precio !== null ? (float)$precio : (float)$item['precio'];
    if ($nombre === '') throw new \InvalidArgumentException('El nombre es obligatorio');
    if ($precio < 0)  throw new \InvalidArgumentException('El precio no puede ser negativo');

    $this->db->execStmt(
      "UPDATE items SET nombre = :n, precio = :p WHERE id = :id",
      [':n' => $nombre, ':p' => $precio, ':id' => $id]
    );
    return $this->obtener($id);
  }

  public function eliminar(int $id): bool {
    $rows = $this->db->execStmt("DELETE FROM items WHERE id = :id", [':id' => $id]);
    return $rows > 0;
  }
}
