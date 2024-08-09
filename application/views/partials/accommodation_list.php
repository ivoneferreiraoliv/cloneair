<style>
.card {
    margin-bottom: 20px; /* Ajuste o valor conforme necessário */
    border: 1px solid #ddd; /* Adiciona uma borda leve */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adiciona uma sombra */
    border-radius: 8px; /* Adiciona cantos arredondados */
    overflow: hidden; /* Garante que o conteúdo do card respeite as bordas arredondadas */
    text-align: center; /* Centraliza o texto */
    display: flex;
    flex-direction: column; /* Garante que o conteúdo do card seja distribuído verticalmente */
    height: 100%; /* Garante que todos os cards tenham a mesma altura */
}

.card-img-top {
    width: 100%;
    height: 200px; /* Defina uma altura fixa para as imagens */
    object-fit: cover; /* Garante que a imagem preencha o espaço sem distorção */
}

.card-body {
    flex-grow: 1; /* Faz com que o card body ocupe o espaço disponível */
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Espaça uniformemente os elementos no card body */
    padding: 15px;
}

.card-body .btn {
    margin: 0 auto; /* Centraliza o botão */
    display: block; /* Garante que o botão seja exibido como bloco */
}
</style>

<div class="container-fluid pt-3">
    <div class="row removable mb-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-1">
                        Acomodações
                        <?php if (isset($search_query) && !empty($search_query)): ?>
                            - Resultados da busca para "<?php echo htmlspecialchars($search_query); ?>"
                            (<?php echo isset($total_accommodations) ? $total_accommodations : 0; ?> encontradas)
                        <?php elseif (isset($category_name) && (is_string($category_name) || is_object($category_name))): ?>
                            - Categoria: <?php echo is_string($category_name) ? htmlspecialchars($category_name) : htmlspecialchars($category_name->name); ?>
                            (<?php echo isset($total_accommodations) ? $total_accommodations : 0; ?> encontradas)
                        <?php endif; ?>
                    </h6>
                </div>
                <!-- Corpo do Card -->
                <div class="card-body p-3">
                    <?php if (!empty($accommodations)): ?>
                        <div class="row">
                            <?php foreach ($accommodations as $accommodation): ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="<?php echo base_url('uploads/' . (!empty($accommodation->photos) ? explode(',', $accommodation->photos)[0] : 'default.jpg')); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($accommodation->name); ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo htmlspecialchars($accommodation->name); ?></h5>
                                            <p class="card-text"><?php echo htmlspecialchars($accommodation->description); ?></p>
                                            <?php if (!empty($accommodation->category_names)): ?>
                                                <p>
                                                    <?php foreach (explode(',', $accommodation->category_names) as $category_name): ?>
                                                        <span class="badge bg-info"><?php echo htmlspecialchars($category_name); ?></span>
                                                    <?php endforeach; ?>
                                                </p>
                                            <?php endif; ?>
                                            <a href="<?php echo base_url('home/detalhe/' . $accommodation->id); ?>" class="btn btn-primary">Ver detalhes</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>Nenhuma acomodação encontrada.</p>
                    <?php endif; ?>
                </div>
                <div class="row text-center py-2">
                    <div class="col-4 mx-auto">
                        <?php echo $pagination; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>