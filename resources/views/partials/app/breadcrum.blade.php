<!--start breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">{{ $breadcrumbs[0]['title'] }}</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">
                @foreach($breadcrumbs as $key => $crumb)
                    <li class="breadcrumb-item {{ $key == count($breadcrumbs) - 1 ? 'active' : '' }}" 
                        aria-current="{{ $key == count($breadcrumbs) - 1 ? 'page' : '' }}">
                        @if($crumb['url'] && $key != count($breadcrumbs) - 1)
                            <a href="{{ $crumb['url'] }}">
                                @if(isset($crumb['icon']))
                                    <ion-icon name="{{ $crumb['icon'] }}"></ion-icon>
                                @endif
                                {{ $crumb['title'] }}
                            </a>
                        @else
                            @if(isset($crumb['icon']))
                                <ion-icon name="{{ $crumb['icon'] }}"></ion-icon>
                            @endif
                            {{ $crumb['title'] }}
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
