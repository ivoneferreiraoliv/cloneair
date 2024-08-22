<style>
   .badge-small {
    font-size: 0.65em;
    padding: 0.25em 0.4em; 
}

.carousel-item img {
    width: 100%;
    max-width: 600px; /* Defina a largura máxima desejada */
    max-height: 300px; /* Defina a altura máxima desejada */
    object-fit: cover; /* Mantém o aspecto da imagem sem distorção */
    margin: 0 auto; /* Centraliza a imagem dentro do carrossel */
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
    max-height: 300px; /* Reduz a altura máxima para 300px */
    max-width: 600px;  /* Reduz a largura máxima para 600px */
    object-fit: cover;
    border-radius: 8px;
    margin: 0 auto;
}
</style>
<?php $this->load->view('partials/navbar', ['username' => $username, 'notifications' => $notifications, 'unread_count' => $unread_count]); ?>
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
                        <?php if ($existing_reservation): ?>
                            <div class="alert alert-info" style="background-color: #007bff; color: #ffffff;">
                                <p>Você já possui uma reserva para esta acomodação.</p>
                                <p><strong>Status da reserva:</strong> <?php echo htmlspecialchars($existing_reservation->status); ?></p>
                                <p><strong>Check-in:</strong> <?php echo date('d/m/Y', strtotime($existing_reservation->checkin_date)); ?></p>
                                <p><strong>Check-out:</strong> <?php echo date('d/m/Y', strtotime($existing_reservation->checkout_date)); ?></p>
                            </div>
                        <?php else: ?>
                            <h4 class="card-title text-center">Reserva</h4>

                                <form action="<?php echo base_url('accommodations/definir_reserva/' . $accommodation->id); ?>" method="POST">
                                    <input type="hidden" name="accommodation_id" value="<?php echo $accommodation->id; ?>">
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
                                <?php endif; ?>
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

        // Script para marcar notificações como lidas
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function() {
                const notificationId = this.getAttribute('data-notification-id');
                if (notificationId) {
                    markNotificationAsRead(notificationId);
                }
            });
        });
    });

    function markNotificationAsRead(notificationId) {
        fetch('<?php echo base_url("notifications/mark_as_read/"); ?>' + notificationId, {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log('Notificação marcada como lida.');
            }
        })
        .catch(error => console.error('Erro ao marcar notificação como lida:', error));
    }
</script>