<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id']; // Enviado pelo formulário (fictício)
    $livro_id = $_POST['livro_id'];

    $sql = "INSERT INTO wishlist (usuario_id, livro_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $usuario_id, $livro_id);

    if ($stmt->execute()) {
        echo "Livro adicionado à Wishlist!";
    } else {
        echo "Erro ao adicionar à Wishlist: " . $conn->error;
    }
}
?>
