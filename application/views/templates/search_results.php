
<body>
    <div class="container">
        <h1>Resultados da Busca</h1>
        <?php if (!empty($accommodations)): ?>
            <div class="row">
                <?php foreach ($accommodations as $accommodation): ?>
                    <div class="col-xl-3 col-md-6 mb-4">
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
            </div>
        <?php else: ?>
            <p>Nenhuma acomodação encontrada</p>
        <?php endif; ?>
    </div>
</body>
</html>
