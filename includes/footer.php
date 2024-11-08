</div>
</div> <!-- Cierra el div content y cualquier otro div abierto en header.php -->

<!-- Importar Bootstrap JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Script para manejar el botón de menú en móviles
    const toggleButton = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    toggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('collapsed');
    });
</script>
</body>

</html>