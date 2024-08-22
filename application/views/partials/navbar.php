<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 mt-3 shadow-none border-radius-xl" id="navbarTop" data-navbar="true" data-navbar-value="49">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="" href="<?php echo base_url('home'); ?>">Home</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Página Atual</li>
            </ol>
            <h6 class="font-weight-bolder mb-0"><a href="<?php echo base_url('home'); ?>" class="text-dark">Clone AirBnb</a></h6>
        </nav>
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <form action="<?php echo base_url('accommodations/search'); ?>" method="GET" class="input-group">
                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                <input type="text" name="query" class="form-control" placeholder="Digite aqui...">
            </form>
        </div>
        <ul class="navbar-nav justify-content-end">
            <li class="nav-item d-flex align-items-center me-3">
                <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                    <i class="fa fa-user me-sm-1" aria-hidden="true"></i>
                    <span class="d-sm-inline d-none"><?php echo htmlspecialchars($username); ?></span>
                </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center me-3">
                <a href="javascript:;" class="nav-link text-body p-0 position-relative" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell cursor-pointer" aria-hidden="true"></i>
                    <?php if (isset($unread_count) && $unread_count > 0): ?>
                        <span class="custom-badge"><?php echo $unread_count; ?></span>
                    <?php endif; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                    <?php if (isset($notifications) && !empty($notifications)) : ?>
                        <?php foreach ($notifications as $notification) : ?>
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;" onclick="markNotificationAsRead(<?php echo $notification['id']; ?>);">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <?php if ($notification['type'] == 'confirmed'): ?>
                                                <img src="<?php echo base_url('assets/img/confirmed.png'); ?>" class="avatar avatar-sm me-3">
                                            <?php elseif ($notification['type'] == 'canceled'): ?>
                                                <img src="<?php echo base_url('assets/img/canceled.png'); ?>" class="avatar avatar-sm me-3">
                                            <?php else: ?>
                                                <img src="<?php echo base_url('assets/img/notification.png'); ?>" class="avatar avatar-sm me-3">
                                            <?php endif; ?>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <?php echo htmlspecialchars($notification['message']); ?>
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1" aria-hidden="true"></i>
                                                <?php echo time_elapsed_string($notification['created_at']); ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            Sem notificações
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php if ($this->session->userdata('logado')): ?>
                <li class="nav-item d-flex align-items-center">
                    <a href="<?php echo base_url('auth/logout'); ?>" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-sign-out-alt me-sm-1" aria-hidden="true"></i>
                        <span class="d-sm-inline d-none">Logout</span>
                    </a>
                </li>
            <?php else: ?>
                <li class="nav-item d-flex align-items-center">
                    <a href="<?php echo base_url('auth/login'); ?>" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-sign-in-alt me-sm-1" aria-hidden="true"></i>
                        <span class="d-sm-inline d-none">Login</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<style>
.custom-badge {
	background-color: red;
    color: white;
    font-size: 0.6rem; /* Reduz o tamanho do texto */
    padding: 2px 6px; /* Ajusta o espaçamento interno */
    border-radius: 50%;
    position: absolute;
    top: -5px; /* Ajuste fino para mover a badge para cima */
    right: -10px; /* Ajuste fino para mover a badge para a direita */
    transform: scale(0.8); /* Reduz ligeiramente o tamanho geral */

}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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

            // Reduz o contador de notificações não lidas
            var unreadCountElement = document.querySelector('.badge-danger');
            var unreadCount = parseInt(unreadCountElement.textContent);

            // Atualiza o contador de notificações não lidas
            unreadCount -= 1;
            if (unreadCount <= 0) {
                unreadCountElement.style.display = 'none'; // Esconde a badge se não houver mais notificações
            } else {
                unreadCountElement.textContent = unreadCount;
            }
        }
    })
    .catch(error => console.error('Erro ao marcar notificação como lida:', error));
}
</script>