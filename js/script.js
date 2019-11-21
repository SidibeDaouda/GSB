function getAnnee() {
    if (document.getElementById('mois')) {
        var mois = document.getElementById('mois');
        var maDate = new Date();
        var jour = maDate.getDate();

        if (jour <= 5) {
            mois.value = maDate.getMonth() + "-" + maDate.getFullYear();
        } else {
            mois.value = (maDate.getMonth() + 1) + "-" + maDate.getFullYear();
        }
    }

}

// ajouter une nouvelle ligne hors forfait en cliquant sur le bouton +
$(document).ready(function() {
    var i = 1;
    $('#add').click(function() {
        i++;
        $('#fraisHF').append('<tr id="row' + i + '"><td><input type="date" name="laDate[]" class="form-control name_list" /></td><td><input type="text" name="libelle[]" placeholder="Libelle" class="form-control name_list" /></td><td><input type="number" name="montant[]" placeholder="Montant" min="0" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
    });
    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });
});