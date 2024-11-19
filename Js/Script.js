document.querySelectorAll('.wishlist-btn').forEach(button => {
    button.addEventListener('click', () => {
        const livroId = button.dataset.livroId;

        fetch('adicionar_wishlist.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ livro_id: livroId })
        })
        .then(response => response.json())
        .then(data => alert(data.message))
        .catch(err => console.error('Erro:', err));
    });
});

document.querySelectorAll('.pedido-btn').forEach(button => {
    button.addEventListener('click', () => {
        const livroId = button.dataset.livroId;

        fetch('adicionar_pedido.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ livro_id: livroId })
        })
        .then(response => response.json())
        .then(data => alert(data.message))
        .catch(err => console.error('Erro:', err));
    });
});
