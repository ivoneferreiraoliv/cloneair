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
        <a href="#"><ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon> Usuários</a>
      </li>
      <li class="px-nav-item ">
        <a href="reservas"><ion-icon name="calendar-outline" role="img" class="md hydrated" aria-label="calendar outline"></ion-icon> Reservas</a>
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
        <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>Usuários / </span>Gerenciar</h1>
    </div>

    <div class="panel">
        <div class="panel-heading" style="padding-left: 10px;">
            <div class="panel-title">Lista de Usuários</div>
        </div>
        <div class="panel-body" style="padding-left: 10px; padding-right: 5px;">
            <a href="<?php echo base_url('admin/usuarios/adicionar/')?>" class="btn btn-success">Adicionar Usuário</a>
        </div>
		
        <div class="table-responsive" style="padding-left: 10px; padding-right: 10px;">
            <table class="table table-striped table-bordered" >
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Nome</th>
                        <th>Tipo de Usuário</th>
                        <th style="width: 120px;">Data de Criação</th>
                        <th style="width: 120px;">Última Atualização</th>
                        <th class="actions">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo $user->id; ?></td>
                                <td><?php echo $user->username; ?></td>
                                <td><?php echo $user->email; ?></td>
                                <td><?php echo $user->first_name . ' ' . $user->last_name; ?></td>
                                <td><?php echo $user->user_type; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($user->created_at)); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($user->updated_at)); ?></td>
                                <td class="actions">
                                    <a href="<?php echo base_url('admin/usuarios/editar/' . $user->id); ?>" class="btn btn-xs btn-warning">Editar</a>
                                    <a href="" class="btn btn-xs btn-danger delete-user" data-user-id="<?php echo $user->id; ?>">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">Nenhum usuário encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
			<?php echo $links_paginacao; ?>
        </div>
    </div>
</div>
        
    </div>
</div>
<script>
  	$(document).on('click', '.delete-user', function(e) {
        e.preventDefault(); 

        const $thisButton = $(this); 
        const userId = $(this).data('user-id');

        Swal.fire({
            title: "Você tem certeza que deseja excluir esse usuário?",
            text: "Essa ação é irreversível",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, excluir!"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                type: 'POST',
                url: baseUrl + "admin/usuarios/excluir/",
                data: {id: userId},
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({ 
                            title: "Excluído!",
                            text: "Usuário excluído com sucesso",
                            icon: "success"
                          });
                        
                        // Remover o elemento da página
                        $thisButton.closest('tr').remove(); 
                    } else {
                        toastr.error(response.message, 'Erro');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Erro ao comunicar com o servidor. Tente novamente mais tarde.', 'Erro');
                }
            });
              
            }
          });

    });
</script>