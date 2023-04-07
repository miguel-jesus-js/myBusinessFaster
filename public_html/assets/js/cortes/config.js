$('#efectivo').keyup(function(){
    let efectivo = $(this).val();
    let saldoFinal = $('#saldo-final').val();
    let diferencia = efectivo - saldoFinal;
    $('#diferencia').html('$'+diferencia);
    $('#diferencia').removeClass('text-danger');
    $('#diferencia').addClass(diferencia > 0 ? 'text-danger' : diferencia < 0 ? 'text-danger' : '');
});
$('#add-corte').submit(function(e){
    e.preventDefault();
    let efectivo = $('#efectivo').val();
    let url = window.location;
    window.open(url.origin+'/printCorteCaja?efectivo='+efectivo,'_blank');
    $('#add-corte').trigger('reset');
    $('#diferencia').removeClass('text-danger');
    $('#diferencia').html('$0.00');
})
