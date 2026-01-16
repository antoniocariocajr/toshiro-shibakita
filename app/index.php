<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exemplo PHP - Melhorado</title>
</head>
<body>

<?php
/**
 * Melhorias Realizadas:
 * 1. Uso de PDO para maior segurança e portabilidade.
 * 2. Prepared Statements para evitar SQL Injection.
 * 3. Variáveis de ambiente para credenciais de banco de dados.
 * 4. Mudança para UTF-8.
 * 5. Separação básica de lógica e exibição.
 */

ini_set("display_errors", 1);
error_reporting(E_ALL);

echo 'Versão Atual do PHP: ' . phpversion() . '<br>';

// Configurações via variáveis de ambiente (com fallbacks para facilitar dev local)
$host     = getenv('DB_HOST')     ?: "db";
$dbName   = getenv('DB_NAME')     ?: "meubanco";
$user     = getenv('DB_USER')     ?: "root";
$password = getenv('DB_PASSWORD') ?: "Senha123";

try {
    $dsn = "mysql:host=$host;dbname=$dbName;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    
    $pdo = new PDO($dsn, $user, $password, $options);

    $valor_rand1 = rand(1, 999);
    $valor_rand2 = strtoupper(substr(bin2hex(random_bytes(4)), 1));
    $host_name = gethostname();

    $sql = "INSERT INTO dados (AlunoID, Nome, Sobrenome, Endereco, Cidade, Host) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $valor_rand1, 
        $valor_rand2, 
        $valor_rand2, 
        $valor_rand2, 
        $valor_rand2, 
        $host_name
    ]);

    echo "<h3>Novo registro criado com sucesso!</h3>";
    echo "ID: $valor_rand1<br>";
    echo "Host: $host_name<br>";

} catch (PDOException $e) {
    echo "Erro na conexão ou query: " . $e->getMessage();
}

?>
</body>
</html>
