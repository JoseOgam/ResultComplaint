# Usage

## Initilization

```php
require_once "database.php";

$db = new Database();
$pdo = $db->getConnection();
```
## Usage

```php
$statement = $pdo->prepare("SELECT * FROM `users`;");
if ($statement->execute()) {
    $users = $statement->fetchAll();
}
```