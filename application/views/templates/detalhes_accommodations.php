<style>
    .badge-small {
        font-size: 0.65em;
        padding: 0.25em 0.4em; 
    }
    .carousel-item img {
    width: 100%;
    height: 400px; /* Defina a altura desejada */
    object-fit: cover; /* Mantém o aspecto da imagem sem distorção */
}
    /* Centraliza o conteúdo e coloca os textos lado a lado */
.accommodation-details {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 20px;
}

/* Ajuste das colunas */
.accommodation-info, .reservation-card {
    flex: 1 1 45%; /* Flexível para ocupar metade do espaço disponível */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 20px;
}

/* Ajuste no conteúdo do formulário de reserva */
.reservation-card {
    max-width: 400px;
}

/* Borda no container principal */
.card-profile {
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
    padding: 20px;
}

/* Estilo para as imagens do carrossel */
.carousel-image {
    max-height: 400px;
    object-fit: cover;
    border-radius: 8px;
}
</style>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 mt-3 shadow-none border-radius-xl" id="navbarTop" data-navbar="true" data-navbar-value="49">
            <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="" href="<?php echo base_url('home'); ?>">Home</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Detalhes da acomodação</li>
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
                      <li class="nav-item d-flex align-items-center">
                          <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                              <i class="fa fa-user me-sm-1" aria-hidden="true"></i>
                              <span class="d-sm-inline d-none">People</span> 
                          </a>
                      </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="https://demos.creative-tim.com/soft-ui-dashboard/assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New message</span> from Laur
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1" aria-hidden="true"></i>
                                                    13 minutes ago
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="https://demos.creative-tim.com/soft-ui-dashboard/assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New album</span> by Travis Scott
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1" aria-hidden="true"></i>
                                                    1 day
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                                <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>credit-card</title>
                                                    <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <g id="Rounded-Icons" transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                            <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                                                <g id="credit-card" transform="translate(453.000000, 454.000000)">
                                                                    <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" id="Path" opacity="0.593633743"></path>
                                                                    <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z" id="Shape"></path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    Payment successfully completed
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1" aria-hidden="true"></i>
                                                    2 days
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5">
        <?php $previous_url = $this->session->userdata('previous_accommodations_url'); ?>
            <a href="javascript:void(0);" onclick="window.location.href='<?php echo htmlspecialchars($previous_url); ?>';" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Voltar</a>

            <div class="card card-profile shadow-lg">
        <div class="card-body">
            <?php if (!empty($accommodation)): ?>
                <div id="accommodationCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php
        // Verifica se a acomodação tem fotos, caso contrário, adiciona uma imagem padrão
        $photos = !empty($accommodation->photos) ? $accommodation->photos : ['default.jpg'];

        foreach ($photos as $index => $photo):
            // Trim elimina espaços em branco ao redor do nome da imagem
            $photo = trim($photo);

            
            if (!empty($photo)):
        ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                <img src="<?php echo base_url('uploads/' . htmlspecialchars($photo)); ?>" class="d-block w-100 carousel-image" alt="Imagem da Acomodação">
            </div>
        <?php
            endif;
        endforeach;
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#accommodationCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#accommodationCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Próximo</span>
    </button>
</div>

<div class="accommodation-details mt-4">
    <div class="accommodation-info">
        <h3 class="card-title text-center"><?php echo htmlspecialchars($accommodation->name); ?></h3>
        <p class="card-description text-center"><?php echo htmlspecialchars($accommodation->description); ?></p>
        <p class="text-center"><strong>Localização:</strong> <?php echo htmlspecialchars($accommodation->location); ?></p>
        <p class="text-center"><strong>Preço por noite:</strong> R$ <?php echo number_format($accommodation->price_per_night, 2, ',', '.'); ?></p>
        <p class="text-center"><strong>Quartos:</strong> <?php echo htmlspecialchars($accommodation->num_rooms); ?></p>
        <p class="text-center"><strong>Banheiros:</strong> <?php echo htmlspecialchars($accommodation->num_bathrooms); ?></p>
        <p class="text-center"><strong>Máximo de hóspedes:</strong> <?php echo htmlspecialchars($accommodation->max_guests); ?></p>
        <div class="text-center">
            <?php 
            if (!empty($accommodation->category_names)) {
                $categories = explode(',', $accommodation->category_names);
                foreach ($categories as $category): ?>
                    <span class="badge bg-info badge-small"><?php echo htmlspecialchars($category); ?></span>
                <?php endforeach;
            } else {
                echo '<span class="badge bg-gradient-secondary badge-small">Sem categorias</span>';
            }
            ?>
        </div>
    </div>

    <div class="reservation-card">
    <?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Salva os dados do formulário na sessão
    $this->session->set_userdata('reservation', [
        'checkin_date' => $this->input->post('checkin_date'),
        'checkout_date' => $this->input->post('checkout_date'),
        'guests' => $this->input->post('guests'),
        'price_per_night' => $accommodation->price_per_night, // Supondo que você tenha essa informação disponível
        'accommodation_id' => $accommodation->id // Supondo que você tenha essa informação disponível
    ]);

    // Redireciona para a página de checkout
    redirect('accommodations/reservar');
}
?>

<div class="reservation-card">
    <h4 class="card-title text-center">Reserva</h4>

    <form action="" method="POST">
        <div class="form-group">
            <label for="checkin_date">Data de Check-in</label>
            <input class="form-control datepicker" id="checkin_date" name="checkin_date" placeholder="Selecione a data" type="text" required>
        </div>

        <div class="form-group">
            <label for="checkout_date">Data de Check-out</label>
            <input class="form-control datepicker" id="checkout_date" name="checkout_date" placeholder="Selecione a data" type="text" required>
        </div>

        <div class="form-group">
            <label for="guests">Número de Hóspedes</label>
            <input class="form-control" id="guests" name="guests" type="number" min="1" max="<?php echo htmlspecialchars($accommodation->max_guests); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Reservar</button>
    </form>
</div>
</div>
            <?php else: ?>
                <p>Acomodação não encontrada.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>


<script src="<?php echo base_url('assets/js/plugins/flatpickr.min.js'); ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkinDate = document.getElementById('checkin_date');
        const checkoutDate = document.getElementById('checkout_date');

        // Inicializa o flatpickr para os campos de data
        flatpickr('.datepicker', {
            dateFormat: 'd/m/Y',
            minDate: 'today',
            locale: 'pt'
        });

        // Atualiza a data mínima do checkout quando a data de check-in é alterada
        checkinDate.addEventListener('change', function() {
            const checkinValue = checkinDate.value;
            flatpickr(checkoutDate, {
                dateFormat: 'd/m/Y',
                minDate: checkinValue,
                locale: 'pt'
            });
        });

        // Valida a data de checkout
        checkoutDate.addEventListener('change', function() {
            const checkinValue = new Date(checkinDate.value.split('/').reverse().join('-'));
            const checkoutValue = new Date(checkoutDate.value.split('/').reverse().join('-'));

            if (checkoutValue <= checkinValue) {
                alert('A data de check-out deve ser posterior à data de check-in.');
                checkoutDate.value = '';
            }
        });
    });
</script>