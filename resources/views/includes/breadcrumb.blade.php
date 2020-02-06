
<div class="panel panel-default">
    <div class="page-header">
    <div class="container-fluid">

      @empty(!$sub_nav)
      <div class="pull-right">
        @foreach($sub_nav as $navObj)
          <a href="{{ $navObj['href'] }}" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Cancel"><i class="{{ $navObj['icon'] }}"></i>{{ $navObj['title'] }}</a>
        @endforeach
      </div>
      @endempty

      <h1>{{ $page_title }}</h1>
      @empty(!$breadcrumb)
      <ul class="breadcrumb">
               @foreach($breadcrumb as $bkey => $breadcrumbObj)
                @php
                  $activeflag =((count($breadcrumb)-1)==$bkey)?'active':"";
                @endphp
                  @if($breadcrumbObj['href'])
                  <li class="{{ $activeflag }}" ><a href="{{ $breadcrumbObj['href'] }}">{{ $breadcrumbObj['title'] }}</a></li>
                  @else
                       <li class="{{ $activeflag}}"> {{ $breadcrumbObj['title'] }} </li>
                  @endif
                @endforeach
              </ul>
        @endempty      
    </div>
  </div>
  </div>