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
          <a href="../../accommodations"><ion-icon name="bed-outline" role="img" class="md hydrated"
              aria-label="bed outline"></ion-icon> Acomodações</a>
        </li>
        <li class="px-nav-item">
          <a href="#"><ion-icon name="people-outline" role="img" class="md hydrated"
              aria-label="people outline"></ion-icon> Usuários</a>
        </li>
        <li class="px-nav-item ">
          <a href="#"><ion-icon name="calendar-outline" role="img" class="md hydrated"
              aria-label="calendar outline"></ion-icon> Reservas</a>
        </li>
    </ul>
  </nav>

  <nav class="navbar px-navbar">
    <!-- Header -->
    <div class="navbar-header">
      <a class="navbar-brand px-demo-brand" href="../../../admin"><span class="px-demo-logo bg-primary"><span
            class="px-demo-logo-1"></span><span class="px-demo-logo-2"></span><span class="px-demo-logo-3"></span><span
            class="px-demo-logo-4"></span><span class="px-demo-logo-5"></span><span class="px-demo-logo-6"></span><span
            class="px-demo-logo-7"></span><span class="px-demo-logo-8"></span><span
            class="px-demo-logo-9"></span></span>Admin AirBnb</a>
    </div>

    <!-- Navbar togglers -->
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-demo-navbar-collapse"
      aria-expanded="false"><i class="navbar-toggle-icon"></i></button>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="px-demo-navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>

  <<div class="px-content">
    <div class="page-header">
      <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>Acomodações /
        </span>Cadastrar</h1>
    </div>

    <div class="panel container" style="padding-top: 0px;">
      <div class="panel-heading" style="padding-left: 2px;">
        <div class="panel-title">Cadastrar nova acomodação</div>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" id=addAccommodationForm action="<?php echo base_url('admin/create_accommodation'); ?>" method="POST">

          <!-- Nome -->
          <div class="form-group">
            <label for="name" class="col-md-3 control-label ">Nome</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="name" name="name" placeholder="Nome" required>
            </div>
          </div>

          <!-- Descrição -->
          <div class="form-group">
            <label for="description" class="col-md-3 control-label">Descrição</label>
            <div class="col-md-9">
              <textarea class="form-control" id="description" name="description" placeholder="Descrição" required></textarea>
            </div>
          </div>

          <!-- Localização -->
          <div class="form-group">
            <label for="location" class="col-md-3 control-label">Localização</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="location" name="location" placeholder="Localização" required>
            </div>
          </div>

          <!-- Preço por Noite -->
          <div class="form-group">
            <label for="price_per_night" class="col-md-3 control-label">Preço por Noite</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="price_per_night" name="price_per_night"
                placeholder="Preço por Noite" required>
            </div>
          </div>  

            <!-- Número de Quartos -->
            <div class="form-group">
              <label for="num_rooms" class="col-md-3 control-label">Número de Quartos</label>
              <div class="col-md-9">
                <input type="number" class="form-control" id="num_rooms" name="num_rooms"
                  placeholder="Número de Quartos" required>
              </div>
            </div>

            <!-- Número de Banheiros -->
            <div class="form-group">
              <label for="num_bathrooms" class="col-md-3 control-label">Número de Banheiros</label>
              <div class="col-md-9">
                <input type="number" class="form-control" id="num_bathrooms" name="num_bathrooms"
                  placeholder="Número de Banheiros" required>
              </div>
            </div>

            <!-- Máximo de Hóspedes -->
            <div class="form-group">
              <label for="max_guests" class="col-md-3 control-label">Máximo de Hóspedes</label>
              <div class="col-md-9">
                <input type="number" class="form-control" id="max_guests" name="max_guests"
                  placeholder="Máximo de Hóspedes" required>
              </div>
            </div>

            <!-- Botão de Submissão -->
            <div class="form-group">
              <div class="col-md-offset-3 col-md-9">
                <button type="submit" class="btn btn-primary" required>Cadastrar Acomodação</button>
              </div>
            </div>
        </form>
      </div>
    </div>
    </div>