<style>
        .card-custom {
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }
        .btn-custom {
            width: 50%;
        }
    </style>

<body class="sign-in-illustration">

  <!-- Content -->
  <section>
    <div class="page-header section-height-75">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 d-flex flex-column mx-auto">
            <div class="card card-plain card-custom">
              <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">Crie sua conta</h3>
                <p class="mb-0">Preencha os campos abaixo para se registrar</p>
              </div>
              <div class="card-body">
                <form role="form" action="<?= base_url('auth/process_register'); ?>" method="post" id="registerForm">
                  <div class="row">
                    <div class="col-md-6">
                      <label>Nome de Usuário</label>
                      <div class="mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Nome de Usuário" required>
                      </div>
                      <label>Email</label>
                      <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                      </div>
                      <label>Senha</label>
                      <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Senha" required>
                      </div>
                      <label>Confirme a Senha</label>
                      <div class="mb-3">
                        <input type="password" name="password_confirm" class="form-control" placeholder="Confirme a Senha" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label>Primeiro Nome</label>
                      <div class="mb-3">
                        <input type="text" name="first_name" class="form-control" placeholder="Primeiro Nome" required>
                      </div>
                      <label>Último Nome</label>
                      <div class="mb-3">
                        <input type="text" name="last_name" class="form-control" placeholder="Último Nome" required>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-info mt-4 mb-0 btn-custom">Registrar</button>
                  </div>
                </form>
                <div class="text-center mt-3">
                  <a href="<?= base_url('auth/login'); ?>" class="btn btn-secondary btn-custom">Já tem uma conta? Entre</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($this->session->flashdata('success')): ?>
            Swal.fire({
                title: "Sucesso!",
                text: "<?= $this->session->flashdata('success'); ?>",
                icon: "success",
                confirmButtonText: "OK"
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            Swal.fire({
                title: "Erro!",
                text: "<?= $this->session->flashdata('error'); ?>",
                icon: "error",
                confirmButtonText: "OK"
            });
        <?php endif; ?>
    });
  </script>