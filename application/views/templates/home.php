<style>
 .category-menu-container {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 5px 0;
    }

    .category-menu {
        display: flex;
        overflow-x: auto;
        scroll-behavior: smooth;
        gap: 20px;
        flex: 1;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .category-menu::-webkit-scrollbar {
        display: none;
    }

    .category-item {
        text-align: center;
        min-width: 80px;
        box-sizing: border-box;
        cursor: pointer;
    }

    .category-item img {
        width: 40px;
        height: 40px;
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        margin-bottom: 2px;
    }

    .category-item p {
        margin-top: 0;
        margin-bottom: 0;
        font-size: 0.8em;
    }

    .scroll-button {
        background-color: #e0e0e0;
        color: #333;
        border: none;
        padding: 5px;
        cursor: pointer;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    .category-item.active {
        border: 2px solid #007bff;
        background-color: #f0f0f0;
    }

    .category-title {
        text-align: center;
        margin-top: 20px;
        font-size: 1.5em;
        font-weight: bold;
        color: #007bff;
    }

.scroll-button {
    background-color: #e0e0e0; /* Cor neutra */
    color: #333; /* Cor mais escura para a seta */
    border: none;
    padding: 5px; /* Reduzir o padding */
    cursor: pointer;
    border-radius: 50%; /* Botão arredondado */
    width: 30px; /* Tamanho fixo para largura */
    height: 30px; /* Tamanho fixo para altura */
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Sombra sutil */
    position: absolute; /* Posição absoluta */
    top: 50%; /* Alinhar verticalmente */
    transform: translateY(-50%); /* Centralizar verticalmente */
}

.category-item.active {
    border: 2px solid #007bff; /* Exemplo de borda azul */
    background-color: #f0f0f0; /* Exemplo de fundo cinza claro */
}
    .card img {
        width: 100%; 
        height: 200px; 
        object-fit: cover; 
    }
    .badge-small {
        font-size: 0.65em;
        padding: 0.25em 0.4em; 
    }
    .pagination-primary li a.page-link {
    color: #007bff;
    border: 1px solid #dee2e6;
    padding: 5px 10px;
    margin: 0 2px;
    border-radius: 5px;
    text-decoration: none;
  }

  .pagination-primary li.active a.page-link {
      background-color: #007bff;
      color: white;
  }
</style>

<body class="">
  
<div class="main-content" id="panel">
<?php $this->load->view('partials/navbar', ['username' => $username, 'notifications' => $notifications, 'unread_count' => $unread_count]); ?>

    <!-- menu categorias -->
    <div class="container mt-4">
        <div class="category-menu-container">
            <div class="category-menu">
                <?php foreach ($categories as $category): ?>
                    <div class="category-item" data-category="<?php echo $category['id']; ?>">
                        <img src="<?php echo base_url('assets/img/' . strtolower($category['name']) . '.png'); ?>" alt="<?php echo $category['name']; ?>">
                        <p><?php echo $category['name']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php if (!empty($selected_category_name)): ?>
        <div class="category-title"><?php echo htmlspecialchars($selected_category_name); ?></div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentCategoryId = '<?php echo isset($selected_category_id) ? $selected_category_id : ''; ?>';

        // Adicionar classe ativa ao item de categoria selecionado
        if (currentCategoryId) {
            document.querySelectorAll('.category-item').forEach(item => {
                if (item.getAttribute('data-category') === currentCategoryId) {
                    item.classList.add('active');
                }
            });
        }

        document.querySelectorAll('.category-item').forEach(item => {
            item.addEventListener('click', function() {
                // Remove a classe 'active' de todos os itens
                document.querySelectorAll('.category-item').forEach(i => i.classList.remove('active'));

                // Adiciona a classe 'active' ao item clicado
                this.classList.add('active');

                // Redireciona para a URL com o ID da categoria selecionada
                const categoryId = this.getAttribute('data-category');
                window.location.href = '<?php echo base_url("home/index"); ?>?category=' + encodeURIComponent(categoryId);
            });
        });

        // Script para marcar notificações como lidas
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function() {
                const notificationId = this.getAttribute('data-notification-id');
                if (notificationId) {
                    markNotificationAsRead(notificationId);
                }
            });
        });
    });

    function markNotificationAsRead(notificationId) {
        fetch('<?php echo base_url("notifications/mark_as_read/"); ?>' + notificationId, {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log('Notificação marcada como lida.');
            }
        })
        .catch(error => console.error('Erro ao marcar notificação como lida:', error));
    }
</script>