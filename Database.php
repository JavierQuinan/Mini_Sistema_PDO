<?php
declare(strict_types=1);

final class Database {
  private static ?Database $instance = null;
  private \PDO $pdo;

  private function __construct(string $dsn, string $user, string $pass) {
    $this->pdo = new \PDO($dsn, $user, $pass, [
      \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
      \PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
  }

  public static function getInstance(
    string $dsn = DB_DSN, string $user = DB_USER, string $pass = DB_PASS
  ): Database {
    if (!self::$instance) {
      self::$instance = new self($dsn, $user, $pass);
    }
    return self::$instance;
  }

  public function pdo(): \PDO { return $this->pdo; }

  /** Query select con bind seguro */
  public function select(string $sql, array $params = []): array {
    $st = $this->pdo->prepare($sql);
    $st->execute($params);
    return $st->fetchAll();
  }

  /** Exec insert/update/delete */
  public function execStmt(string $sql, array $params = []): int {
    $st = $this->pdo->prepare($sql);
    $st->execute($params);
    return $st->rowCount();
  }

  public function lastId(): string { return $this->pdo->lastInsertId(); }

  /** Tx helpers */
  public function tx(callable $fn) {
    $this->pdo->beginTransaction();
    try {
      $result = $fn($this);
      $this->pdo->commit();
      return $result;
    } catch (\Throwable $e) {
      $this->pdo->rollBack();
      throw $e;
    }
  }
}
