<body class="sign-in-illustration">

  <!-- Content -->
  <section>
    <div class="page-header section-height-75">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-7 d-flex flex-column mx-auto">
            <div class="card card-plain">
              <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">Bem-vindo de volta</h3>
                <p class="mb-0">Entre com seu e-mail e senha para acessar</p>
              </div>
              <div class="card-body">
                <form role="form" action="<?= base_url('auth/process_login'); ?>" method="post">
                  <label>Email</label>
                  <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                  </div>
                  <label>Senha</label>
                  <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Senha" required>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-info w-100 mt-4 mb-0">Entrar</button>
                  </div>
                </form>
                <div class="text-center mt-3">
                  <a href="<?= base_url('registrar'); ?>" class="btn btn-secondary w-100">Cadastrar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
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