<style>
  .category-menu-container {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    padding: 5px 0; /* Reduzir o padding para diminuir a altura */
}

.category-menu {
    display: flex;
    overflow-x: auto;
    scroll-behavior: smooth;
    gap: 20px; /* Ajustar o gap entre categorias */
    flex: 1;
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}

.category-menu::-webkit-scrollbar {
    display: none;  /* Chrome, Safari, Opera */
}

.category-item {
    text-align: center;
    min-width: 80px; /* Reduzir a largura mínima */
    box-sizing: border-box;
}

.category-item img {
    width: 40px; /* Reduzir largura */
    height: 40px; /* Reduzir altura */
    max-width: 100%; /* Garantir que a imagem não exceda o contêiner */
    max-height: 100%; /* Garantir que a imagem não exceda o contêiner */
    object-fit: contain; /* Conter a imagem dentro das dimensões */
    margin-bottom: 2px; /* Ajustar a margem inferior */
}

.category-item p {
    margin-top: 0; /* Remover qualquer margem superior */
    margin-bottom: 0; /* Remover qualquer margem inferior */
    font-size: 0.8em; /* Ajustar o tamanho da fonte */
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

.scroll-button-left {
    left: -15px; /* Mover o botão esquerdo para fora */
}

.scroll-button-right {
    right: -15px; /* Mover o botão direito para fora */
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

<body class="blog-author bg-gray-100">
  
<div class="main-content" id="panel">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 mt-3 shadow-none border-radius-xl" id="navbarTop" data-navbar="true" data-navbar-value="49">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="" href="javascript:;"></a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Home</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Clone AirBnb</h6>
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

      <!-- menu categorias -->
      <div class="container mt-4">
    <div class="category-menu-container">
    <button class="scroll-button scroll-button-left">&#9664;</button>
        <div class="category-menu">
        <div class="category-item">
                <img src="<?php echo base_url('assets/img/praia.png'); ?>" alt="Em frente a praia">
                <p>Em frente a praia</p>
            </div>
            <div class="category-item">
                <img src="<?php echo base_url('assets/img/pousada.png'); ?>" alt="Pousadas">
                <p>Pousadas</p>
            </div>
            <div class="category-item">
                <img src="<?php echo base_url('assets/img/chalé.png'); ?>" alt="Chalés">
                <p>Chalés</p>
            </div>
            <div class="category-item">
                <img src="<?php echo base_url('assets/img/fazenda.png'); ?>" alt="Fazendas">
                <p>Fazendas</p>
            </div>
            <div class="category-item">
                <img src="<?php echo base_url('assets/img/mansao.png'); ?>" alt="Mansões">
                <p>Mansões</p>
            </div>
            <div class="category-item">
                <img src="<?php echo base_url('assets/img/quarto.png'); ?>" alt="Quartos">
                <p>Quartos</p>
            </div>
            <div class="category-item">
                <img src="<?php echo base_url('assets/img/economico.png'); ?>" alt="Econômico">
                <p>Econômico</p>
            </div>
            <div class="category-item">
                <img src="<?php echo base_url('assets/img/luxo.png'); ?>" alt="Luxo">
                <p>Luxo</p>
            </div>
            <div class="category-item">
                <img src="<?php echo base_url('assets/img/casa.png'); ?>" alt="Casa inteira">
                <p>Casa inteira</p>
            </div>
            <div class="category-item">
                <img src="<?php echo base_url('assets/img/apartamento.png'); ?>" alt="Apartamento">
                <p>Apartamento</p>
            </div>
            <div class="category-item">
                <img src="<?php echo base_url('assets/img/favoritos.png'); ?>" alt="Favoritos">
                <p>Favoritos</p>
            </div>
            <div class="category-item">
                <img src="<?php echo base_url('assets/img/piscina.png'); ?>" alt="Piscinas Incríveis">
                <p>Piscinas Incríveis</p>
            </div>
        </div>
        <button class="scroll-button scroll-button-right">&#9654;</button>
    </div>
</div>

<div class="container-fluid pt-3">
            <div class="row removable mb-4">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-1">Acomodações</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <?php if (!empty($accommodations)): ?>
                                    <?php foreach ($accommodations as $accommodation): ?>
                                        <div class="col-xl-4 col-md-6 mb-4">
                                            <div class="card card-blog card-plain">
                                                <div class="position-relative">
                                                    <a class="d-block shadow-xl border-radius-xl">
                                                        <?php
                                                        $image_url = !empty($accommodation->photo) ? base_url('uploads/' . $accommodation->photo) : base_url('uploads/default.jpg');
                                                        ?>
                                                        <img src="<?php echo $image_url; ?>" alt="Imagem da Acomodação" class="img-fluid shadow border-radius-xl">
                                                    </a>
                                                </div>
                                                <div class="card-body px-1 pb-0">
                                                    <p class="text-gradient text-dark mb-2 text-sm"><?php echo $accommodation->name; ?></p>
                                                    <a href="javascript:;">
                                                        <h5><?php echo $accommodation->name; ?></h5>
                                                    </a>
                                                    <p class="mb-4 text-sm"><?php echo $accommodation->description; ?></p>
                                                    <p><strong>Localização:</strong> <?php echo $accommodation->location; ?></p>
                                                    <p><strong>Preço por noite:</strong> R$ <?php echo number_format($accommodation->price_per_night, 2, ',', '.'); ?></p>
                                                    <p><strong>Quartos:</strong> <?php echo $accommodation->num_rooms; ?></p>
                                                    <p><strong>Banheiros:</strong> <?php echo $accommodation->num_bathrooms; ?></p>
                                                    <p><strong>Máximo de hóspedes:</strong> <?php echo $accommodation->max_guests; ?></p>
                                                    <div>
                                                        <?php 
                                                        if (!empty($accommodation->category_names)) {
                                                            $categories = explode(',', $accommodation->category_names);
                                                            foreach ($categories as $category): ?>
                                                                <span class="badge bg-gradient-primary badge-small"><?php echo $category; ?></span>
                                                            <?php endforeach;
                                                        } else {
                                                            echo '<span class="badge bg-gradient-secondary badge-small">Sem categorias</span>';
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                                        <button type="button" class="btn btn-outline-primary btn-sm mb-0">Ver detalhes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>Nenhuma acomodação encontrada</p>
                                <?php endif; ?>
                            </div>
                            <!-- Exibir a paginação aqui -->
                            <div class="row text-center py-2">
                              <div class="col-4 mx-auto">
                                <?php echo $pagination; ?>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function scrollLeft() {
                    document.querySelector('.category-menu').scrollBy({
                        left: -150,
                        behavior: 'smooth'
                    });
                }

                function scrollRight() {
                    document.querySelector('.category-menu').scrollBy({
                        left: 150,
                        behavior: 'smooth'
                    });
                }

                // Adiciona os event listeners aos botões
                document.querySelector('.scroll-button-left').addEventListener('click', scrollLeft);
                document.querySelector('.scroll-button-right').addEventListener('click', scrollRight);
            });
        </script>