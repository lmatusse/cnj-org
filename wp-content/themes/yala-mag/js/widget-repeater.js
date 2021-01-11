jQuery(document).ready(function(jQuery) {

    var isha_document = jQuery(document);

    isha_document.on('click','.media-image-upload', function(e){

        // Prevents the default action from occuring.
        e.preventDefault();
        var media_image_upload = jQuery(this);
        var media_title = jQuery(this).data('title');
        var media_button = jQuery(this).data('button');
        var media_input_val = jQuery(this).prev();
        var media_image_url_value = jQuery(this).prev().prev().children('img');
        var media_image_url = jQuery(this).siblings('.img-preview-wrap');

        var meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: media_title,
            button: { text:  media_button },
            library: { type: 'image' }
        });
        // Opens the media library frame.
        meta_image_frame.open();
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            media_input_val.val(media_attachment.url);
            if( media_image_url_value !== null ){
                media_image_url_value.attr( 'src', media_attachment.url );
                media_image_url.show();
                LATESTVALUE(media_image_upload.closest("p"));
            }
        });
    });

    var count = 0;
    jQuery("body").on('click','.yala-mag-add-features', function(e) {
        e.preventDefault();
        var additional = jQuery(this).parent().parent().find('.yala-mag-additional');
        var container = jQuery(this).parent().parent().parent().parent();

        var container_class = container.attr('id');

        var arr = container_class.split('-');

        var val=  arr[1].split('_');

        val.shift();

        var liver=  val.join('_')

        var container_class_array = container_class.split(liver+"-");
        var instance = container_class_array[1];
        var add = jQuery(this).parent().parent().find('.yala-mag-add-features');
        count = additional.find('.yala-mag-sec').length;

        //Json response
        jQuery.ajax({
            type      : "GET",
            url       : ajaxurl,
            data      : {
                action: 'yala_mag_wp_posts_plucker',
            },
            dataType: "json",
            success: function (data) {
                var options = '<option disabled>Select Posts</option>';

                jQuery.each(data, function( index, value ) {
                    var option = '<option value="'+index+'">'+value+'</option>';
                    options += option;
                });
             
                additional.append(
                    '<div class="yala-mag-sec"><div class="sub-option section widget-upload">'+
                    '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count+'-post_ids">Select Posts</label>'+
                    '<select class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count+'-post_ids"'+
                    'name="widget-'+liver+'['+instance+'][repeaters]['+count+'][post_ids]">'+ options + '</select>' +
                    '<a class="yala-mag-remove delete">Remove Section</a></div></div>' );
            }
        });
    });

    // Counter section
    var count1 = 0;
    jQuery("body").on('click','.yala-mag-add-footer-social', function(e) {
        e.preventDefault();
        var additional = jQuery(this).parent().parent().find('.yala-mag-additional-footer-social');
        var container = jQuery(this).parent().parent().parent().parent();

        var container_class = container.attr('id');

        var arr = container_class.split('-');

        var val=  arr[1].split('_');

        val.shift();

        var liver=  val.join('_')

        var container_class_array = container_class.split(liver+"-");
        var instance = container_class_array[1];
        var add = jQuery(this).parent().parent().find('.mag-add-footer-social');
        count1 = additional.find('.yala-mag-sec-footer-social').length;

        additional.append(
            '<div class="yala-mag-sec-footer-social yala-mag-sec"><div class="sub-option section widget-upload">'+
            '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count1+'-social_icon">Social Icon(Use font awesome icon:  <a href="https://fontawesome.com/v4.7.0/icons/"  target="_blank">See more here</a>)</label>'+
            '<input type="text" class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count1+'-social_icon"'+
            'name="widget-'+liver+'['+instance+'][repeaters]['+count1+'][social_icon]">'+
            '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count1+'-social_url">Social Url</label>'+
            '<input type="text" class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count1+'-social_url"'+
            'name="widget-'+liver+'['+instance+'][repeaters]['+count1+'][social_url]">'+
            '<a class="yala-mag-remove delete">Remove Section</a></div></div>' );
        });  

    //Logo section
    var count2 = 0;
    jQuery("body").on('click','.isha-add-logo', function(e) {
        e.preventDefault();
        var additional = jQuery(this).parent().parent().find('.isha-additional-logo');
        var container = jQuery(this).parent().parent().parent().parent();

        var container_class = container.attr('id');

        var arr = container_class.split('-');

        var val=  arr[1].split('_');

        val.shift();

        var liver=  val.join('_')

        var container_class_array = container_class.split(liver+"-");
        var instance = container_class_array[1];
        var add = jQuery(this).parent().parent().find('.isha-add-logo');
        count2 = additional.find('.isha-sec-logo').length;

        additional.append(
            '<div class="isha-sec-logo" id="logo'+count2+'"><div class="sub-option section widget-upload">'+
            '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count2+'-image_url">Image Upload</label>'+
            '<img class="custom_media_image_logo" src="" id="custom_media_image_logo'+count2+'">'+
            '<input type="hidden" class="widefat custom_media_url_logo"'+ 'name="widget-'+liver+'['+instance+'][repeaters]['+count2+'][image_url]" id="custom_media_url_logo'+count2+'">'+
            '<input type="button" value="Upload Image" class="button custom_media_upload_logo" id="custom_image_upload-'+count2+'">'+
            '<a class="isha-remove delete">Remove Section</a></div></div>' );
        });

        jQuery(".yala-mag-remove").live('click', function() {
            jQuery(this).parent().parent().remove();
            jQuery('input[name="savewidget"]').removeAttr('disabled');
        });
});


// Widget Media Uploader
jQuery(document).ready( function(){
function media_upload( button_class) {
var _custom_media = true,
_orig_send_attachment = wp.media.editor.send.attachment;
jQuery('body').on('click',button_class, function(e) {
    var button_id ='#'+jQuery(this).attr('id');
    /* console.log(button_id); */
    var self = jQuery(button_id);
    var send_attachment_bkp = wp.media.editor.send.attachment;
    var button = jQuery(button_id);
    var id = button.attr('id').replace('_button', '');
    _custom_media = true;
    wp.media.editor.send.attachment = function(props, attachment){
        if ( _custom_media  ) {
           jQuery('.custom_media_id').val(attachment.id); 
           jQuery('.custom_media_url').val(attachment.url);
               jQuery('.custom_media_image').attr('src',attachment.url).css('display','block');   
        } else {
            return _orig_send_attachment.apply( button_id, [props, attachment] );
        }
          $('input[name="savewidget"]').removeAttr('disabled');
    }
    wp.media.editor.open(button);
    return true;
});
}
media_upload( '.custom_media_upload');
});


