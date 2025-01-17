
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
        <a href="admin/usuarios"><ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon> Usuários</a>
      </li>
      <li class="px-nav-item ">
        <a href="admin/reservas"><ion-icon name="calendar-outline" role="img" class="md hydrated" aria-label="calendar outline"></ion-icon> Reservas</a>
      </li>
    </ul>
  </nav>

  <nav class="navbar px-navbar">
    <!-- Header -->
    <div class="navbar-header">
      <a class="navbar-brand px-demo-brand" href="#"><span class="px-demo-logo bg-primary"><span class="px-demo-logo-1"></span><span class="px-demo-logo-2"></span><span class="px-demo-logo-3"></span><span class="px-demo-logo-4"></span><span class="px-demo-logo-5"></span><span class="px-demo-logo-6"></span><span class="px-demo-logo-7"></span><span class="px-demo-logo-8"></span><span class="px-demo-logo-9"></span></span>Admin AirBnb</a>
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
      <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>Acomodações 
    </div>


   
    <div class="container">

    <div class="panel">
      <div class="panel-heading">
        <div class="panel-title">Acomodações</div>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-info"id="datatables">
            <thead>
              <tr>
                <th>#</th>
                <th>Nome</th>
                
                <th>Localização</th>
                <th>Preço por Noite</th>
                <th>Quartos</th>
                <th>Banheiros</th>
                <th>Máx. Hóspedes</th>
                <th>Criado em</th>
                
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($accommodations)): ?>
                  <?php foreach ($accommodations as $accommodation): ?>
                    <tr>
                      <td><?php echo $accommodation->id; ?></td>
                      <td><?php echo $accommodation->name; ?></td>
                      
                      <td><?php echo $accommodation->location; ?></td>
                      <td>R$ <?php echo number_format($accommodation->price_per_night, 2, ',', '.'); ?></td>
                      <td><?php echo $accommodation->num_rooms; ?></td>
                      <td><?php echo $accommodation->num_bathrooms; ?></td>
                      <td><?php echo $accommodation->max_guests; ?></td>
                      <td><?php echo date('d/m/y', strtotime($accommodation->created_at)); ?></td> 
          
                    </tr>
                  <?php endforeach; ?>
              <?php else: ?>
                  <tr>
                    <td colspan="10">Nenhuma acomodação encontrada.</td>
                  </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

 

 


