
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva/Checkout</title>
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="./assets/css/soft-design-system.css?v=1.0.9" rel="stylesheet" />
    <style>
        .reservation-summary,
        .payment-section,
        .policy-section {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f8f9fa;
        }

        .total-price {
            font-weight: bold;
            font-size: 1.2em;
        }

        .btn-primary,
        .btn-secondary {
            width: 100%;
        }

        .policy-section h6 {
            margin-top: 10px;
        }
    </style>
</head>
<?php
/**
 * @var object $accommodation
 */
?>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 mt-3 shadow-none border-radius-xl" id="navbarTop" data-navbar="true" data-navbar-value="49">
            <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="" href="<?php echo base_url('home'); ?>">Home</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Reservar</li>
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


		
        <?php
// Recupera os dados da sessão
$reservation = $this->session->userdata('reservation');
?>

<div class="container mt-5">
    <form id="backForm" action="<?php echo base_url('accommodations/detalhes/' . $reservation['accommodation_id']); ?>" method="POST" style="display: none;">
        <input type="hidden" name="price_per_night" value="<?php echo $reservation['price_per_night']; ?>">
        <input type="hidden" name="checkin_date" value="<?php echo $reservation['checkin_date']; ?>">
        <input type="hidden" name="checkout_date" value="<?php echo $reservation['checkout_date']; ?>">
        <input type="hidden" name="guests" value="<?php echo $reservation['guests']; ?>">
    </form>

    
    <!-- Botão Voltar -->
    <?php $previous_details_url = $this->session->userdata('previous_details_url'); ?>
    <a href="javascript:void(0);" onclick="window.location.href='<?php echo htmlspecialchars($previous_details_url); ?>';" class="btn btn-secondary mb-3" style="width: auto;"><i class="fas fa-arrow-left"></i> Voltar</a>

    <div class="row">
        <!-- Informações de Preço -->
        <div class="col-md-5">
            <div class="reservation-summary">
                <h5>Informações de preço</h5>
                <p>R$<?php echo htmlspecialchars(number_format($accommodation->price_per_night, 2, ',', '.')); ?>/noite</p>
                <p>Taxa de limpeza: R$50</p>
                <p>Taxa de serviço: R$30</p>
                <p class="total-price">Total: R$<?php echo htmlspecialchars(number_format($reservation['total_price'], 2, ',', '.')); ?></p>
                <button class="btn btn-secondary">Plano de parcelamento</button>
            </div>

           <!-- Informações do Pagamento -->
<div class="payment-section mt-4">
    <h5>Pagar com</h5>
    <div class="btn-group w-100 mb-3" role="group">
        <button type="button" class="btn btn-secondary" onclick="selectPaymentMethod('credit_card')">Cartão de Crédito</button>
        <button type="button" class="btn btn-outline-secondary" onclick="selectPaymentMethod('pix')">PIX</button>
    </div>

    <form id="paymentForm">
        <input type="hidden" name="payment_method" id="paymentMethod" value="credit_card">
        
        <!-- Campos de Cartão de Crédito -->
        <div id="creditCardFields">
            <div class="mb-3">
                <label for="cardName" class="form-label">Nome no Cartão</label>
                <input type="text" class="form-control" id="cardName" name="card_name" placeholder="Nome como aparece no cartão">
            </div>
            <div class="mb-3">
                <label for="cardNumber" class="form-label">Número do Cartão</label>
                <input type="text" class="form-control" id="cardNumber" name="card_number" placeholder="1234 5678 9101 1121">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cardExpiry" class="form-label">Data de Expiração</label>
                    <input type="text" class="form-control" id="cardExpiry" name="card_expiry" placeholder="MM/AA">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cardCVC" class="form-label">CVC</label>
                    <input type="text" class="form-control" id="cardCVC" name="card_cvc" placeholder="CVC">
                </div>
            </div>
        </div>

        <!-- Campos de PIX -->
        <div id="pixFields" style="display: none;">
            <p>Para pagar com PIX, escaneie o código QR abaixo:</p>
            <img src="" alt="QR Code PIX">
        </div>

        <button type="submit" class="btn btn-primary">Reservar e Pagar</button>
    </form>
</div>
        </div>

        <!-- Detalhes da Reserva -->
        <div class="col-md-7">
            <div class="reservation-summary">
                <h5>Sua reserva</h5>
                <p>Datas: <strong><?php echo isset($reservation['checkin_date']) ? htmlspecialchars($reservation['checkin_date']) : 'N/A'; ?></strong> até <strong><?php echo isset($reservation['checkout_date']) ? htmlspecialchars($reservation['checkout_date']) : 'N/A'; ?></strong></p>
                <p>Hóspedes: <strong><?php echo isset($reservation['guests']) ? htmlspecialchars($reservation['guests']) : 'N/A'; ?> Hóspedes</strong></p>
            </div>

            <!-- Política de Cancelamento e Regras -->
            <div class="policy-section mt-4">
                <h6>Política de cancelamento:</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <h6>Regras básicas:</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
    </div>
</div>

<script>
function selectPaymentMethod(method) {
    document.getElementById('paymentMethod').value = method;
    if (method === 'credit_card') {
        document.getElementById('creditCardFields').style.display = 'block';
        document.getElementById('pixFields').style.display = 'none';
    } else {
        document.getElementById('creditCardFields').style.display = 'none';
        document.getElementById('pixFields').style.display = 'block';
    }
}

document.getElementById('paymentForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);

    fetch('<?php echo base_url('accommodations/process_payment'); ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Pagamento realizado com sucesso!',
                text: 'Sua reserva foi confirmada.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '<?php echo base_url('minhasreservas'); ?>';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Erro no pagamento',
                text: data.message || 'Falha no processamento do pagamento. Tente novamente.',
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Erro no pagamento',
            text: 'Ocorreu um erro inesperado. Por favor, tente novamente.',
            confirmButtonText: 'OK'
        });
    });
});
</script>