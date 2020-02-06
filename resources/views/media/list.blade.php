@extends('default')
@section('content')

<div id="page-wrapper">
 @include('includes.breadcrumb')
	       		<div class="main-page">
                     @include('includes.notification')
                    <div class="panel panel-default">
                        <div class="panel-body">
                       <div class="panel-heading">
                            <div class="heading-elements">
                                <button title="Upload Media" type="button" onclick="loadUploaderWithGallery('.txt_container', 'media_id', 'single')" class="btn btn-primary"><i class="fa fa-upload"></i></button>
                            </div>
                        </div>         

                    <div class="panel panel-default">
				<div class="table-responsive">
                     @include('includes.notification')
           		 <table class="table table-striped">
	                <thead>
	                    <tr>
	                        <th>#</th>
	                        <th>Name</th>
	                        <th>Module</th>
	                        <th>Size</th>
	                        <th>Created</th>
	                        <th>&nbsp;</th>
	                    </tr>
	                </thead>
                <tbody>
                        @foreach($mediaData as $media)
                    <tr>
                        <td><img src="{{ $media->base_url.'/small/'.$media->file_name}}" class="img-responsive thumb" width="50" height="50" data-cdn="{{ Config::get('constants.CND_PATH') }}" data-url="{{ Config::get('app.url').'media/singlemedia/' }}" data-id="" /></td>
                        <td>{{ substr($media->original_name,0,10) }}...</td>
                        <td>{{ $media->module }}</td>
                        <td>{{ $media->file_size }}</td>
                        <td>{{  dateformat($media->created_at,'datetime') }}</td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="text-danger-600"><a onclick="return confirm('Are you sure you want to delete?')" href="{{ url('media/delete/'.$media->media_id) }}"><i class="fa fa-trash"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $mediaData->links() }}
        </div>
        </div>
			</div>
            
		</div>
        </div>
            
        </div>
@include('media.gallery-inline-js',['module' => 'Common', 'base_url'=> Config::get('app.url')])   
@stop