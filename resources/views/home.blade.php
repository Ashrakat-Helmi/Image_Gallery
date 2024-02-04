@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div><h2>Images</h2> </div>
                        <div>

                            <form class="form-inline" >
                                <div class="row">
                                    <div class="col-auto pt-2">Sort by &nbsp;</div>
                                        <div class="col-auto">
                                        <select class="form-select" onchange="sort_by(this.value)">
                                            <option value="latest" {{(Request::query('sort_by') && Request::query('sort_by') == 'latest'|| !Request::query('sort_by'))?'selected':''}}>Latest</option>
                                            <option value="oldest" {{(Request::query('sort_by') && Request::query('sort_by') == 'oldest')?'selected':''}}>Oldest</option>
                                        </select>
                                        </div>
                                </div>
                                
                                
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <div class="row">
                        
                        <div class="col-md-3">
                            <p>Filter by Category</p>
                            <div class="list-group">
                                <a href="javascript:filter_images('')" class="list-group-item list-group-item-action {{(!Request::query('category'))?'active':''}}" >All</a>
                                <a href="javascript:filter_images('personal')" class="list-group-item list-group-item-action {{(Request::query('category')=='personal')?'active':''}}">Personal</a>
                                <a href="javascript:filter_images('friends')" class="list-group-item list-group-item-action {{(Request::query('category')=='friends')?'active':''}}">Friends</a>
                                <a href="javascript:filter_images('family')" class="list-group-item list-group-item-action {{(Request::query('category')=='family')?'active':''}}">Family</a>
                            </div>
                        </div>
                        <div class="col-md-9">

                            <div class="row">
                                <div class="col-md-12">
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            {{$error}}
                                        @endforeach
                                    @endif

                                    <p class="d-inline-flex gap-1">
                                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                          Add Image
                                        </button>
                                    </p>
                                    <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <form method="POST" action="{{route('Image_store')}}" enctype="multipart/form-data" id="image_upload_form">
                                            @csrf
                                            <div class="mb-3">
                                              <label for="caption" class="form-label">Image Caption</label>
                                              <input type="text" name="caption" class="form-control" id="caption">
                                            </div>
                                            <div class="mb-3">
                                              <label for="category" class="form-label">Image Category</label>
                                              <select class="form-select" name="category" id="category" aria-label="Default select example">
                                                <option value="">Select Image Category</option>
                                                <option value="personal">Personal</option>
                                                <option value="friends">Friends</option>
                                                <option value="family">Family</option>
                                              </select>
                                            </div>
                                            <div class="mb-3">   
                                                <div class="form-group">
                                                    <label class="control-label">Upload File</label>
                                                    <div class="preview-zone hidden">
                                                      <div class="box box-solid">
                                                        <div class="box-header with-border">
                                                          <div><b>Preview</b></div>
                                                          <div class="box-tools pull-right">
                                                            <button type="button" class="btn btn-danger btn-xs remove-preview">
                                                              <i class="fa fa-times"></i> Reset This Form
                                                            </button>
                                                          </div>
                                                        </div>
                                                        <div class="box-body"></div>
                                                      </div>
                                                    </div>
                                                    <div class="dropzone-wrapper">
                                                      <div class="dropzone-desc">
                                                        <i class="glyphicon glyphicon-download-alt"></i>
                                                        <p>Choose an image file or drag it here.</p>
                                                      </div>
                                                      <input type="file" name="image" class="dropzone">
                                                    </div>
                                                </div>
                                                <div id="image_error"></div>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>                            
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="row">
                                     @if (count($images))
                                         @foreach ($images as $image)
                                         <div class="col-md-3 mb-4 " id="gallery">
                                            <a href="{{asset('img/'.$image->image) }}" class="fancybox" data-caption="{{$image->caption}}" data-id="{{$image->id}}" data-fancybox="gallary">
                                                <img src="{{asset('img/'.$image->image) }}" width="100%" height="300px">
                                                <input type="hidden"  id="image_id" value="{{$image->id}}">
                                            </a>
                                        </div>
                                         @endforeach

                                     @else
                                     <div class="col-md-12 mb-4">
                                        No Images Found. Please Upload Image
                                        </div>
                                     @endif
                                    @if (count($images))
                                    <div class="col-md-10">
                                        {{ $images->appends(Request::query())->links()}}
                                    </div>
                                    @endif
                                       
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <form method="post" action="" id="image-delete-form">
        @csrf
        @method('DELETE');
    </form>
@endsection

@section('js')
<script >
var query = {};
@if (Request::query('category'))
Object.assign(query,{'category': "{{Request::query('category')}}"});
@endif
@if (Request::query('sort_by'))
Object.assign(query,{'sort_by': "{{Request::query('sort_by')}}"});
@endif
function filter_images(value){
    Object.assign(query,{'category': value});
    window.location.href="{{route('home')}}"+'?'+$.param(query);

}
function sort_by(value){
    Object.assign(query,{'sort_by': value});
    window.location.href="{{route('home')}}"+'?'+$.param(query);

}
 let current_image_id = '';
// $('.fancybox').attr('rel','gallary').fancybox({
//     berforShow:function(instant,item){
//         current_image_id=item.opts.id;
//     }
// });

$('.fancybox').on('click',function(e){
    current_image_id = this.querySelector('#image_id').value;
});
Fancybox.bind("#gallery a", {
  groupAll: true,
});
Fancybox.bind('[data-fancybox]', {
Toolbar: {
    items: {
    delete: {
        tpl: "<button class='f-button fancybox-delete-button'>Delete</button>",
        click: () => {
            Swal.fire({
                title: 'Are you sure?',
                text: 'you want to Delete this image!',
                icon: 'error',
                confirmButtonText: 'Yes',
                showCancelButton:true,
                showCloseButton:true,
                confirmButtonColor: '#FF0000'
            })
            .then((result) => { 
                if (result.isConfirmed) {
                    var base_url = "{{URL::to('/')}}";
                    $('#image-delete-form').attr('action',base_url+'/Image_delete/'+current_image_id);
                    $('#image-delete-form').submit();
                } else if (result.isDismissed) {
                    Fancybox.getInstance().close();
                }
            })                                    
        }
    },
    },
    display: {
        left: ["infobar"],
        middle: [],
        right: ["delete","slideshow", "download", "thumbs", "close"],
    },
},
hideScrollbar: false,
});    

// $('body').on('click','button.fancybox-delete-button',function(e){
    
//     alert('delete');
// });
// $.fancybox.defaults.btnTpl.delete="<button class='fancybox-button fancybox-delete-button'>Delete</button>";
// $.fancybox.defaults.buttons=['delete','close','share','download'];
$("#image_upload_form").validate({
  rules: {
    caption: {
      required: true,
      maxlength: 255
    },
    category: {
      required: true
    },
    image: {
      required: true,
      extension: "png|jpg|jpeg"
    }
  },
  messages: {
    caption: {
      required: "Please ,Enter Image Caption!",
      maxlength: jQuery.validator.format("At Max {255} characters required!")
    },
    category: {
      required: "Please ,Select Image category!"
    },
    image: {
      required: "Please ,Upload an Image !",
      extension: "Only png|jpg|jpeg allowed"
    }
  },
  errorPlacement:function(error,element){
    if(element.attr("name") == "image"){
        error.insertAfter('#image_error');
    }else{
        error.insertAfter(element);
    }
  }
});




function readFile(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {

        var validImageType = ['image/png','image/jpg','image/jpeg'];
        if(!validImageType.includes(input.files[0]['type'])){
            var htmlPreview =
        '<p> Image Preview not available</p>' +
        '<p> nly png|jpg|jpeg allowed</p>' ;
        }else{
            var htmlPreview =
        '<img width="70%" height="300px" src="' + e.target.result + '" />' +
        '<p>' + input.files[0].name + '</p>';
        }

      var wrapperZone = $(input).parent();
      var previewZone = $(input).parent().parent().find('.preview-zone');
      var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

      wrapperZone.removeClass('dragover');
      previewZone.removeClass('hidden');
      boxZone.empty();
      boxZone.append(htmlPreview);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function reset(e) {
  e.wrap('<form>').closest('form').get(0).reset();
  e.unwrap();
}

$(".dropzone").change(function() {
  readFile(this);
});

$('.dropzone-wrapper').on('dragover', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).addClass('dragover');
});

$('.dropzone-wrapper').on('dragleave', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).removeClass('dragover');
});

$('.remove-preview').on('click', function() {
  var boxZone = $(this).parents('.preview-zone').find('.box-body');
  var previewZone = $(this).parents('.preview-zone');
  var dropzone = $(this).parents('.form-group').find('.dropzone');
  boxZone.empty();
  previewZone.addClass('hidden');
  reset(dropzone);
});

</script>
@endsection
