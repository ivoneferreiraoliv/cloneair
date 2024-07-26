<style>
    .error {
      color: red;
      font-size: 0.875em;
    }
    .is-invalid {
      border-color: red;
    }
  </style>
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

  <div class="px-content">
    <div class="page-header">
        <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>Usuários /</span> Cadastrar</h1>
    </div>

    <div class="panel container" style="padding-top: 0px;">
        <div class="panel-heading" style="padding-left: 2px;">
            <div class="panel-title">Cadastrar novo usuário</div>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" id="addUserForm" action="<?php echo base_url('admin/usuarios/adicionar'); ?>" method="POST">

                <!-- Nome de Usuário -->
                <div class="form-group">
                    <label for="username" class="col-md-3 control-label">Nome de Usuário</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Nome de Usuário" required>
                    </div>
                </div>

                <!-- Senha -->
                <div class="form-group">
                    <label for="password" class="col-md-3 control-label">Senha</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                </div>

                <!-- Primeiro Nome -->
                <div class="form-group">
                    <label for="first_name" class="col-md-3 control-label">Primeiro Nome</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Primeiro Nome" required>
                    </div>
                </div>

                <!-- Sobrenome -->
                <div class="form-group">
                    <label for="last_name" class="col-md-3 control-label">Sobrenome</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Sobrenome" required>
                    </div>
                </div>

                <!-- Tipo de Usuário -->
                <div class="form-group">
                    <label for="user_type" class="col-md-3 control-label">Tipo de Usuário</label>
                    <div class="col-md-9">
                        <select class="form-control" id="user_type" name="user_type" required>
                            <option value="admin">Admin</option>
                            <option value="user">Usuário</option>
                        </select>
                    </div>
                </div>

                <!-- Botão de Submissão -->
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn btn-primary" required>Cadastrar usuário</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
      // Adicionar validação jQuery Validation
      $("#addUserForm").validate({
        rules: {
          username: {
            required: true,
            minlength: 3
          },
          password: {
            required: true,
            minlength: 6
          },
          email: {
            required: true,
            email: true
          },
          first_name: {
            required: true
          },
          last_name: {
            required: true
          },
          user_type: {
            required: true
          }
        },
        messages: {
          username: {
            required: "Por favor, insira um nome de usuário",
            minlength: "O nome de usuário deve ter pelo menos 3 caracteres"
          },
          password: {
            required: "Por favor, insira uma senha",
            minlength: "A senha deve ter pelo menos 6 caracteres"
          },
          email: {
            required: "Por favor, insira um email",
            email: "Por favor, insira um email válido"
          },
          first_name: {
            required: "Por favor, insira o primeiro nome"
          },
          last_name: {
            required: "Por favor, insira o sobrenome"
          },
          user_type: {
            required: "Por favor, selecione um tipo de usuário"
          }
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid').addClass('is-valid');
        }
      });

      // Submissão do formulário via AJAX
      $('#addUserForm').on('submit', function (event) {
        event.preventDefault();
        console.log("Form submission intercepted");

        if ($("#addUserForm").valid()) { 
          var formData = $(this).serialize();
          $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            success: function (response) {
              if (response.status === 'success') {
                toastr.success(response.message, 'Sucesso');
                setTimeout(function () {
                  window.location.href = '<?php echo base_url('users/listar_admin'); ?>';
                }, 2000);
              } else {
                toastr.error('Erro: ' + response.message, 'Erro');
              }
            },
            error: function (xhr, status, error) {
              toastr.error('Erro ao comunicar com o servidor. Tente novamente mais tarde.', 'Erro');
            }
          });
        }
      });
    });
  </script>