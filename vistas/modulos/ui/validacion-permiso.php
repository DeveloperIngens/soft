<?php if(isset($_SESSION["obtiene_permiso"]) && $_SESSION["obtiene_permiso"] != "SI-PERMISO"): ?>

    <?php if($_SESSION["obtiene_permiso"] != "SI-PERMISO"):?>

        <script>

            swal({

                type: 'error',
                title: '¡No tiene permisos para estar en esta pagina, sera redireccionado al Inicio del Sistema!',
                showConfirmButton: true,
                confirmButtonText: 'Cerrar'

            }).then(function(result){

                    window.location = 'inicio';

            });

        </script>

    <?php endif ?>

<?php endif ?>