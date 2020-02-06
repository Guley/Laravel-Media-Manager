<link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/core.min.css') }}" rel="stylesheet">
<div id="gallery_container" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close closemediapop" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Media Gallery</h5>
            </div>
            <div class="modal-body">
                <h6 class="text-semibold">Upload Images</h6>
                <p><input type="file" name="upload_img" class="file-input-ajax" multiple="multiple" accept="image/x-png, image/gif, image/jpeg" ></p>
                <hr>
                <h6 class="text-semibold">Saved Images</h6>
                <div class="datatable-header">
                    <div class="dataTables_filter">
                        <label>
                            <span>Filter:</span>
                            <input class="form-control search_txt" type="search" placeholder="Type to filter..." >
                        </label>
                        <button class="btn btn-primary" type="button" onclick="sf()" >Search</button>
                    </div>
                    <div class="dataTables_length col-md-6" >
                        <div class="col-md-4">
                            <label>
                            <select class="form-control" name="set_modules" onchange="refreshImageList()" >
                                <option value="" >- All Categories -</option>
                            </select></label>
                        </div>
                        <div class="col-md-4">
                            <label><span></span> 
                            <select class="form-control" name="gallery_pages" class="select2" onchange="refreshImageList()" >
                                <option value="1">Page 1</option>
                            </select></label>
                        </div>
                    </div>
                </div>
                <div class="row image_list"></div>
            </div>
        </div>
    </div>
</div>
<script>
    var page = 1;
    var search = '';
    var selection_type = '';
    var field_container = '';
    var hidden_field_name = '';
    var selected_images = '';
    var img_ = 'img_';

    /*
     * 
     * @field_container {string} div which have input field(s)
     * @hidden_field_name {string} input field name
     * @type {string} single, multi
     * 
     */
    function loadUploaderWithGallery(field_container, hidden_field_name, type,selected_images='selected_images',img_='img_') {
        window.selection_type = type;
        window.field_container = field_container;
        window.hidden_field_name = hidden_field_name;
        window.selected_images = selected_images;
        window.img_ = img_;
        $('#gallery_container').modal('show');
        refreshImageList();
    }

    function refreshImageList() {
        page = $('select[name="gallery_pages"]').val();
        module = $('select[name="set_modules"]').val();
        var search_string = '';
        if (search != '') {
			page=0;
            search_string = '&search=' + search;
        }
        if(module != ''){
            search_string = '&module=' + module;
        }
        
        //$("#gallery_container").blockUI();
        $.ajax({
            
            url: "{{ $base_url }}media/getimages?page="+ page + search_string,
            dataType: 'json',
            type: 'get',
            success: function (data) {
                if (data.total > 0) {
                    $(data.list).each(function (key, imglist) {
                        var htmlContent = imgGalleryContent(imglist.image_url, imglist.image_id, imglist.image_name,selected_images,img_);
                        if (key == 0) {
                            $(".image_list").html(htmlContent);
                        } else {
                            $(".image_list").append(htmlContent);
                        }
                        
                        var pageHtml = '';
                        for(p=1;p<=data.pages;p++){
                            var is_selected = (page==p)?'selected=selected':'';
                            pageHtml = pageHtml+'<option '+is_selected+' value="'+p+'" >Page '+p+'</option>';
                        }
                        $('select[name="gallery_pages"]').html(pageHtml);
                        
                        $('select[name="set_modules"]').html(data.module);
                    })
                } else if (page == 1) {
                    $(".image_list").html('<div class="alert alert-danger" >No images uploaded yet!</div>');
                }
                //$("#gallery_container").unblockUI();
            }
        })
    }
    
    function imgGalleryContent(image_url, image_id, image_name,selected_images='selected_images',img_='img_'){
        return '<div class="col-lg-2 col-sm-3"><div class="thumbnail"><div class="thumb"><img src="' + image_url + '" alt=""><div class="caption-overflow"><span><a href="javascript:void(0);" onclick="addImage(' + image_id + ', \'' + image_url + '\', \'' + image_name + '\', \'' + selected_images + '\', \'' + img_ + '\')" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="fa fa-plus-circle"></i></a><h6 class="no-margin image_title" >' + image_name.substr(0, 10)  + '</h6></span></div></div></div></div>';
    }
    
    function addImgContent(imgId, image_url, image_name,img_='img_'){
        return '<div class="col-lg-2 col-sm-3 '+img_+imgId+'" ><div class="thumbnail"><div class="thumb"><img src="' + image_url + '" alt=""><div class="caption-overflow"><span><a href="javascript:void(0);" class="btn border-white text-white btn-flat btn-icon btn-rounded" onclick="removeImg('+imgId+', \''+selection_type+'\', \''+field_container+'\', \''+hidden_field_name+'\', \''+img_+'\')" ><i class="fa fa-trash"></i></a><h6 class="no-margin image_title" >' + image_name.substr(0, 10)  + '</h6></span></div></div></div></div>';
    }
    
    function addImage(imgId, imgUrl, image_name,selected_images='selected_images',img_='img_'){
        if(selection_type == 'single'){
            $("."+selected_images).html(addImgContent(imgId, imgUrl, image_name,img_));
            $(field_container).find('input[name="'+hidden_field_name+'"]').val(imgId);
            $('#gallery_container').modal('hide');
        } else {
            $("."+selected_images).append(addImgContent(imgId, imgUrl, image_name,img_));
            $(field_container).find('input[name="'+hidden_field_name+'"]').filter(function(){return this.value==''}).remove();
            $(field_container).append('<input type="hidden" name="'+hidden_field_name+'" value="'+imgId+'" >');
        }
    }

    function sf(){
        window.search = $(".search_txt").val();
        refreshImageList();
    }
    
    function removeImg(id, qty_type, input_container, hidden_field,img_='img_'){
        

        if(confirm("Are you sure to remove this?")){
            if(qty_type == 'single'){
                $(input_container).find('input[name="'+hidden_field+'"]').val('');
            } else {
                $(input_container).find('input[name="'+hidden_field+'"][value="'+id+'"]').remove();
            }
            $("."+img_+id).remove();
        }
    }
    
    $(function(){
        $('.file-input-ajax').on('filepreupload', function(event, data, previewId, index, jqXHR) {
            data.form.append("_token", $('meta[name="csrf-token"]').attr('content'));
        }); 
        // AJAX upload
        $(".file-input-ajax").fileinput({
            uploadUrl: "{{ $base_url }}media/uploadimages?m={{ $module }}", // server upload action
            uploadAsync: true,
            uploadExtraData: {id: 1},
            allowedFileTypes: ['image'],
            allowedFileExtensions : ['jpg', 'gif', 'png'],
            browseOnZoneClick: true,
            previewTemplates: {
            image: '<div class="file-preview-frame" id="{previewId}" data-fileindex="{fileindex}" data-template="{template}">\n' + '   <div class="kv-file-content">' + '       <img src="{data}" class="kv-preview-data file-preview-image" title="{caption}" alt="{caption}" >\n' + '   </div>\n' + '   {footer}\n' + '</div>\n'
            },
            layoutTemplates : {
                footer: '<div class="file-thumbnail-footer">\n' + '    <div class="file-caption-name" style="width:{width}">{caption}</div>\n' + ' {actions}\n' + '</div>',
                actions: '<div class="file-actions">\n' + '    <div class="file-footer-buttons">\n' +
            '         {delete}  ' + '    </div>\n' + '    \n' + '    <div class="file-upload-indicator" title="{indicatorTitle}">{indicator}</div>\n' + '    <div class="clearfix"></div>\n' + '</div>'
            },
            fileActionSettings: {
                removeIcon: '<i class="fa fa-trash"></i>',
                removeClass: 'btn btn-link btn-xs btn-icon',
                uploadIcon: '<i class="fa fa-upload"></i>',
                uploadClass: 'btn btn-link btn-xs btn-icon',
                indicatorNew: '<i class="fa fa-file-plus text-slate"></i>',
                indicatorSuccess: '<i class="fa fa-check file-icon-large text-success"></i>',
                indicatorError: '<i class="fa fa-times text-danger"></i>',
                indicatorLoading: '<i class="fa fa-spinner spinner text-muted"></i>'
            },
            previewSettings: {
                image: {width: "auto", height: "40px"},
            }
        }).on('filebatchuploadsuccess', function(event, data, previewId, index) {
            //refreshImageList();
            //$(this).fileinput('refresh');
            console.log('batch called');
         }).on('fileuploaded', function(event, data, previewId, index) {

            if(index==0){
                
                refreshImageList();
                setTimeout(function(){ $('.file-input-ajax').fileinput('refresh'); }, 2000)
            }
            
        });
        
        $('#gallery_container').on('hide.bs.modal', function (e) {
            $('.file-input-ajax').fileinput('refresh');
        })
    });
    $(document).on('click','.closemediapop',function(){
        //location.reload();
    });
</script>