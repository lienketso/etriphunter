$('.bravo-form-register-vendor [type=submit]').click(function (e) {
    e.preventDefault();
    let form = $(this).closest('.bravo-form-register-vendor');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': form.find('meta[name="csrf-token"]').attr('content')
        }
    });
    var url = form.attr('action');
    var agency_type = form.find('input[name="agency_type"]:checked').val();
    var bio = tinymce.get("vendorCk").getContent();
    $.ajax({
        'url': url,
        'data': {
            'email': form.find('input[name=email]').val(),
            'password': form.find('input[name=password]').val(),
            'first_name': form.find('input[name=first_name]').val(),
            'last_name': form.find('input[name=last_name]').val(),
            'business_name': form.find('input[name=business_name]').val(),
            'phone': form.find('input[name=phone]').val(),
            'file_agency': form.find('input[name=file_agency]').val(),
            'bio': bio,
            'agency_type': agency_type,
            'term': form.find('input[name=term]').is(":checked") ? 1 : '',
            'g-recaptcha-response': form.find('[name=g-recaptcha-response]').val(),
        },
        'type': 'POST',
        beforeSend: function () {
            form.find('.error').hide();
            form.find('.icon-loading').css("display", 'inline-block');
            form.find('.message-error').hide();
        },
        success: function (data) {
            form.find('.icon-loading').hide();
            if (data.error === true) {
                if (data.messages !== undefined) {
                    for(var item in data.messages) {
                        var msg = data.messages[item];
                        form.find('.error-'+item).show().text(msg[0]);
                    }
                }
                if (data.messages.message_error !== undefined) {
                    form.find('.message-error').show().html('<div class="alert alert-danger">' + data.messages.message_error[0] + '</div>');
                }
            }
            if(data.status){
                if(data.message){
                    form.find('.message-error').show().html('<div class="alert alert-success">' + data.message + '</div>');
                }
                if (typeof data.redirect !== 'undefined') {
                    window.setTimeout(function () {
                        window.location.href = data.redirect;
                    },5000);
                    return;
                }
            }

            if(data.redirect){
                window.location.href = data.redirect;
                return;
            }

        },
        error:function (e) {
            form.find('.icon-loading').hide();
            if(typeof e.responseJSON !== "undefined" && typeof e.responseJSON.message !='undefined'){
                form.find('.message-error').show().html('<div class="alert alert-danger">' + e.responseJSON.message + '</div>');
            }
        }
    });
})
//Input group image select
$('.upload-btn-wrapper').each(function () {
    var container = $(this);
    $(document).on('change', '.btn-file :file', function (event) {
        var files = event.target.files;
        var input = $(this);
        var formData = new FormData();
        $.each(files, function (key, value) {
            formData.append('file', value);
        });
        formData.append('type', "file");
        $.ajax({
            url: '/admin/module/media/storeNoAuth',
            type: 'POST',
            data: formData,
            enctype: 'multipart/form-data',
            beforeSend: function () {
                input.trigger("bravo-file-before-update")
            },
            success: function (data) {
                if (data.status === 1) {
                    input.trigger("bravo-file-update-success", data)
                } else {
                    input.trigger("bravo-file-update-error", data.message)
                }
            },
            error: function (xhr) {
                input.trigger("bravo-file-update-error")
            },
            complete: function () {
                input.trigger("bravo-file-update-complete")
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
    container.find('.btn-file :file').on('bravo-file-update-success', function (event, data) {
        console.log(data);
        container.find("input[type=hidden]").attr('value', data.data.id);
        container.find(".image-demo").attr('src', data.data.sizes.default);
        container.find(".text-view").attr('value', data.data.sizes.default);
    });
    container.find('.btn-file :file').on('bravo-file-before-update', function () {
        container.find(".text-view").attr('value', container.find(".text-view").data("loading"));
    });
    container.find('.btn-file :file').on('bravo-file-update-error', function (event, message) {
        if (message.length > 0) {
            container.find(".text-view").attr('value', message);
        } else {
            container.find(".text-view").attr('value', container.find(".text-view").data("error"));
        }
    });
});

// Form Configs
$('.has-ckeditor').each(function () {
    var els  = $(this);

    var id = $(this).attr('id');

    if(!id){
        id = makeid(10);
        $(this).attr('id',id);
    }
    var h  = els.data('height');
    if(!h && typeof h =='undefined') h = 300;

    // CKEDITOR.replace( id );
    tinymce.init({
        selector:'#'+id,
        plugins: 'preview searchreplace autolink code fullscreen image link media codesample table charmap hr toc advlist lists wordcount imagetools textpattern help pagebreak hr',
        toolbar: 'formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | link image media | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | pagebreak codesample code| removeformat',
        image_advtab: true,
        image_caption: true,
        toolbar_drawer: 'sliding',
        relative_urls : false,
        height:h,
        file_picker_callback: function (callback, value, meta) {
            /* Provide file and text for the link dialog */
            if (meta.filetype === 'file') {
                uploaderModal.show({
                    multiple:false,
                    file_type:'video',
                    onSelect:function (files) {
                        if(files.length)
                            callback(bookingCore.url+'/media/preview/'+files[0].id);
                    },
                });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
                uploaderModal.show({
                    multiple:false,
                    file_type:'image',
                    onSelect:function (files) {
                        if(files.length)
                            callback(files[0].thumb_size);
                    },
                });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === 'media') {
                uploaderModal.show({
                    multiple:false,
                    file_type:'video',
                    onSelect:function (files) {
                        if(files.length)
                            callback(bookingCore.url+'/media/preview/'+files[0].id);
                    },
                });
            }
        },
    });

});
