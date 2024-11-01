(function( $ ) {
    $(document).on( 'click', '#set_modified_date_btn', function() {
        var checked = $("input[name='update_modified_date']").is(':checked');
        $('#bulk_modified_msg').hide().html('');

        if(false == checked) {
            $('#bulk_modified_msg').show().html('<p style="color: red;">Please check the box and CLICK "set", if you wish to update the Modified Date</p>');
            return false;
        } else {
            var $bulk_row = $( '#bulk-edit' );
            var post_ids = new Array();

            $bulk_row.find( '#bulk-titles' ).children().each( function() {
                post_ids.push( $( this ).attr( 'id' ).replace( /^(ttle)/i, '' ) );
            });

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'save_custom_bulk_modified_update',
                    post_ids: post_ids
                },
                success: function(data) {
                    $('#bulk_modified_msg').show().html('<p style="color: green;">Modified Date Has Been Updated</p>');
                    return false;
                }
            });
        }
    });

})( jQuery );
