$(function() {

  var translate_street = "";
  var populate_translate_street = "";
  var edit_populate_translate_street = "";
  var edit_translate_street = "";

  $("#content_address_postal").autocomplete({
    source: "/operator/search/devotee_info",
    minLength: 1,
    select: function(event, ui) {
      $('#content_address_postal').val(ui.item.value);
    }
  });

  $("#content_address_postal").on('focusout', function() {
    var address_postal = $(this).val();

    var formData = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        address_postal: address_postal
    };

    $.ajax({
        type: 'GET',
        url: "/operator/search/address_translate",
        data: formData,
        dataType: 'json',
        success: function(response)
        {
          $("#content_address_houseno").val(response.translate_street[0].address_houseno);
          $("#content_address_street").val(response.translate_street[0].english);

          var address_houseno = $("#content_address_houseno").val();
          var address_unit1 = $("#content_address_unit1").val();
          var address_unit2 = $("#content_address_unit2").val();
          var address_postal = $("#content_address_postal").val();

          if($.trim(address_unit1).length <= 0 && $.trim(address_unit2).length <= 0)
          {
            var full_address = address_houseno + ", " + response.translate_street[0]['chinese'] + ", " + address_postal;

            translate_street = response.translate_street[0]['chinese'];
            $("#address_translated").val(full_address);
          }
          else
          {
            var full_address = address_houseno + ", #" + address_unit1 + "-" + address_unit2 + ", " + response.translate_street[0]['chinese'] +  ", " +
                                address_postal;

            translate_street = response.translate_street[0]['chinese'];
            $("#address_translated").val(full_address);
          }
        },

        error: function (response) {
            console.log(response);
        }
    });
  });
