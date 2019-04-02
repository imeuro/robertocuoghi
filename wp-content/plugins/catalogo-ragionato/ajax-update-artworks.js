jQuery(document).ready(function($) {
var data = {};
  jQuery('.custom_media_upload').click(function() {
    //console.debug('..click');
      var send_attachment_bkp = wp.media.editor.send.attachment;
      wp.media.editor.send.attachment = function(props, attachment) {
          jQuery('.custom_media_file').addClass('updated').html('<b>File CSV caricato con successo!</b><br><b>file:</b> '+attachment.url+'<br><b>ID allegato:</b> '+attachment.id).fadeIn();
          jQuery('#startbutton').removeAttr('disabled');
          wp.media.editor.send.attachment = send_attachment_bkp;

          data = {
              action: 'run_update',
              file: attachment.url,
              file_ID: attachment.id
          };

      }
      wp.media.editor.open();
      return false;
  });



	var loading = $("#loading");
  $(document).ajaxStart(function () {
      loading.fadeIn();
  });
  $(document).ajaxStop(function () {
      loading.fadeOut();
  });
	jQuery('#startbutton').click(function(){
		jQuery.post(ajaxurl, data, function(response) {
        jQuery('#run_update_content').html(response);
        jQuery('#startbutton').attr('disabled','disabled').after('&nbsp;&nbsp;&nbsp;&nbsp;<button class="button dashicons-before dashicons-update" onclick="location.reload();" style="line-height:20px;">&nbsp;&nbsp;Esegui un altro update</button>');
				var err_count = 0;
				jQuery('#run_update_content tr').each(function(i){
					var UpdResult = $(this).find('td.result b').text();
					if (i>1 && UpdResult != 'aggiornato!') {
						$(this).css('background-color','#ffc4c4');
						 err_count++;
					}
				});

				jQuery('#insert-result').html('Update result: there are <b>'+err_count+'</b> errors!');

    });
	})


});
