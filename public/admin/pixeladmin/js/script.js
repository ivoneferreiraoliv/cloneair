// navbar
$(document).ready(function() {
	// Alternar visibilidade do menu
	$('.px-nav-toggle').on('click', function() {
	  $('#main-nav').toggleClass('hidden');
	  let toggleLabel = $('.px-nav-toggle-label');
	  if (toggleLabel.text() === 'SHOW MENU') {
		toggleLabel.text('HIDE MENU');
	  } else {
		toggleLabel.text('SHOW MENU');
	  }
	});

	// Fechar o box de boas-vindas
	$('#demo-px-nav-box .close').on('click', function() {
	  $('#demo-px-nav-box').hide();
	});
  });


  $(document).ready(function() {
    $('#addAccommodationForm').on('submit', function(event) {
        event.preventDefault(); 

        var formData = $(this).serialize(); 
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'), 
            data: formData,
            dataType: 'json',
            success: function(response) {
                if(response.status === 'success') {
                    toastr.success(response.message, 'Sucesso'); 
                    setTimeout(function() {
                        window.location.href = '../../accommodations';
                    }, 2000);
                } else {
                    // Trata erros de validação ou outros erros
                    toastr.error('Erro: ' + response.message, 'Erro');
                }
            },
            error: function(xhr, status, error) {
                // Aqui você pode lidar com erros
                toastr.error('Erro ao comunicar com o servidor. Tente novamente mais tarde.', 'Erro');
            }
        });
    });
});   



// form edit
$(document).ready(function() {
    $('#editAccommodationForm').on('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        var formData = $(this).serialize(); 
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'), 
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if(response.status === 'success') {
                    toastr.success(response.message, 'Sucesso'); 
                    setTimeout(function() {
                        window.location.href = '../../accommodations';
                    }, 2000);
                } else {
                    toastr.error('Erro: ' + response.message, 'Erro');
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Erro ao comunicar com o servidor. Tente novamente mais tarde.', 'Erro');
            }
        });
    });
});


$(document).ready(function() {
    // Inicialize o DataTables
    $('#datatables').DataTable();

    // Função para excluir acomodação
    $('#datatables').on('click', '.delete-accommodation', function(e) {
        e.preventDefault(); 

        var accommodationId = $(this).data('accommodation-id'); // Extrair o ID
        var $thisButton = $(this); // Guardar o botão para uso posterior

        Swal.fire({
            title: "Você tem certeza que deseja excluir essa acomodação?",
            text: "Essa ação é irreversível",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, excluir!"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                type: 'POST',
                url: baseUrl + "admin/accommodations/excluir",
                data: {id: accommodationId},
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({ 
                            title: "Excluído!",
                            text: "Acomodação excluída com sucesso",
                            icon: "success"
                          });
                        // toastr.success(response.message, 'Sucesso');
                        // Remover o elemento da página
                        $thisButton.closest('tr').remove(); 
                    } else {
                        toastr.error(response.message, 'Erro');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Erro ao comunicar com o servidor. Tente novamente mais tarde.', 'Erro');
                }
            });
              
            }
          });

    });
});

