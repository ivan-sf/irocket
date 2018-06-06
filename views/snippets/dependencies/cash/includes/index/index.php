                    <div class="grid-stack" data-gs-width="12" data-gs-animate="yes">
                        
                        <div class="grid-stack-item" data-gs-x="0" data-gs-y="0" data-gs-width="8" data-gs-height="8">
                            <div class="grid-stack-item-content">
                                <?php if (isset($_GET['proceso'])) {
                                echo "
                                <div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-success alert-dismissible fade show' role='alert' id='alertabien'>
                                <div class='m-alert__icon'>
                                <i class='flaticon-rocket'></i>
                                </div>
                                <div class='m-alert__text'>
                                <strong>
                                Genial !
                                </strong>
                                Factura registrada
                                </div>
                                <div class='m-alert__close'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                </div>
                                </div>";
                            }else{

                            } ?>
                                <h2><b><?php echo $_SESSION['cash']; ?></b> <small><small><?php if (isset($_GET['caja'])) {
                                    echo ucfirst($_GET['caja']);
                                } ?></small></small></h2>
                                <?php include "includes/lista_de_productos.php"; ?>
                                <?php include "includes/facturacion/products.php"; ?>

                            </div>
                        </div>
                        <div class="grid-stack-item" data-gs-x="8" data-gs-y="0" data-gs-width="4" data-gs-height="8">
                            <div class="grid-stack-item-content">
                                
                                <?php include "includes/factura.php"; ?>
                                
                            </div>
                        </div>
                        
                    </div>

<script>
    
$(document).ready(function () {
    //$("#alertabien").slideUp(5000).delay(5000);

    $('#alertabien').delay(1000).slideToggle(1000, function () {
        $('#alertabien').removeClass("show");
    });
    return false;
});

</script>