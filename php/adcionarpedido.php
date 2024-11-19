<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id']; // Enviado pelo formulário (fictício)
    $livro_id = $_POST['livro_id'];
    $quantidade = $_POST['quantidade'];

    $sql = "INSERT INTO pedidos (usuario_id, livro_id, quantidade) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $usuario_id, $livro_id, $quantidade);

    if ($stmt->execute()) {
        echo "Pedido realizado com sucesso!";
    } else {
        echo "Erro ao realizar pedido: " . $conn->error;
    }
}
?>
