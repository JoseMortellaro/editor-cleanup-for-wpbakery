jQuery(document).ready(function($){
  $(".eos-dp-save-eos_dp_ecfwpb_" + fdp_wpbakery.page).on("click", function () {
    $('.eos-dp-opts-msg').addClass('eos-hidden');
    var chk,str = '';
    $('.eos-dp-wpbakery').each(function(){
      chk = $(this);
      str += !chk.is(':checked') ? ',' + $(this).attr('data-path') : ',';
    });
    eos_dp_send_ajax($(this),{
      "nonce" : $("#eos_dp_wpbakery_" + fdp_wpbakery.page + "_setts").val(),
      "eos_dp_wpbakery_data" : str,
      "page" : fdp_wpbakery.page,
      "action" : 'eos_dp_save_wpbakery_' + fdp_wpbakery.page + '_settings'
    });
    return false;
  });
});
