<body>
   <!-- Botão de alternância fora do menu -->
   <button type="button" class="px-nav-toggle" data-toggle="px-nav">
    <span class="px-nav-toggle-arrow"></span>
    <span class="navbar-toggle-icon"></span>
    <span class="px-nav-toggle-label font-size-11">SHOW MENU</span>
  </button>

  <nav class="px-nav px-nav-left" id="main-nav">
  <ul class="px-nav-content">
      <<li class="px-nav-box p-a-3 b-b-1" id="demo-px-nav-box" style="margin-top: 60px;">
        <div class="btn-group" style="margin-top: 4px;">
        <div class="font-size-16"><span class="font-weight-light">Bem vindo! </span></div>
        <a href="<?php echo base_url('admin/logout'); ?>" class="btn btn-xs btn-danger btn-outline"><i class="fa fa-power-off"></i> Logout</a>
        </div>
      </li>

      <li class="px-nav-item ">
      <a href="<?php echo base_url('admin/accommodations'); ?>">
        <ion-icon name="bed-outline" role="img" class="md hydrated" aria-label="bed outline"></ion-icon> Acomodações</a>
      </li>
      <li class="px-nav-item">
        <a href="usuarios"><ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon> Usuários</a>
      </li>
      <li class="px-nav-item ">
        <a href="#"><ion-icon name="calendar-outline" role="img" class="md hydrated" aria-label="calendar outline"></ion-icon> Reservas</a>
      </li>
    </ul>
  </nav>

  <nav class="navbar px-navbar">
    <!-- Header -->
    <div class="navbar-header">
      <a class="navbar-brand px-demo-brand" href="../admin"><span class="px-demo-logo bg-primary"><span class="px-demo-logo-1"></span><span class="px-demo-logo-2"></span><span class="px-demo-logo-3"></span><span class="px-demo-logo-4"></span><span class="px-demo-logo-5"></span><span class="px-demo-logo-6"></span><span class="px-demo-logo-7"></span><span class="px-demo-logo-8"></span><span class="px-demo-logo-9"></span></span>Admin AirBnb</a>
    </div>

    <!-- Navbar togglers -->
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-demo-navbar-collapse" aria-expanded="false"><i class="navbar-toggle-icon"></i></button>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="px-demo-navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>

  <div class="px-content">
    <div class="page-header">
        <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>Reservas / </span>Gerenciar</h1>
    </div>

    <div class="panel">
        <div class="panel-heading" style="padding-left: 10px;">
            <div class="panel-title">Lista de Reservas</div>
        </div>
        
        <div class="table-responsive" style="padding-left: 10px; padding-right: 10px;">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Acomodação</th>
                        <th>Data de Início</th>
                        <th>Data de Fim</th>
                        <th>Status</th>
                        <th class="actions">Ações</th>
                    </tr>
                </thead>
                <tbody>
              <?php if (!empty($reservations)): ?>
                <?php foreach ($reservations as $reservation): ?>
                <tr id="reservation-<?php echo $reservation->id; ?>">
                    <td><?php echo $reservation->id; ?></td>
                    <td><?php echo $reservation->user_id; ?></td>
                    <td><?php echo $reservation->accommodation_id; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($reservation->checkin_date)); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($reservation->checkout_date)); ?></td>
                    <td class="reservation-status"><?php echo $reservation->status; ?></td>
                    <td>
                        <button data-id="<?php echo $reservation->id; ?>" class="btn btn-xs btn-success btn-confirm">Confirmar</button>
                        <button data-id="<?php echo $reservation->id; ?>" class="btn btn-xs btn-danger btn-reject">Recusar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Nenhuma reserva encontrada.</td>
            </tr>
        <?php endif; ?>
          </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('.btn-confirm').click(function() {
        var reservationId = $(this).data('id');
        updateReservationStatus(reservationId, 'confirmada');
    });

    $('.btn-reject').click(function() {
        var reservationId = $(this).data('id');
        updateReservationStatus(reservationId, 'cancelada');
    });

    function updateReservationStatus(id, status) {
        $.ajax({
            url: '<?php echo base_url("reservations/update_status_ajax"); ?>',
            type: 'POST',
            data: {
                id: id,
                status: status
            },
            success: function(response) {
                var result = JSON.parse(response);
                if (result.success) {
                    $('#reservation-' + id + ' .reservation-status').text(status);
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: result.message,
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: result.message,
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Ocorreu um erro na requisição.',
                    confirmButtonText: 'OK'
                });
            }
        });
    }
});
</script>
