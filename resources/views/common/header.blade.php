<nav class="navbar navbar-expand-lg header-navbar" style="z-index: 1">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <div class="zk-logo" style="background-color: #C30D23; width: 128px; height: 64px"></div>
        </a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @foreach($menus as $menu)
                @if(sizeof($menu->children) == 0)
                    <li class="nav-item">
                        <a class="nav-link" style="word-break: keep-all" href="{{$child->value}}">{{$menu->menu_code}}</a>
                    </li>
                @else
                    <li class="nav-item dropdown dropdown-center">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{$menu->menu_code}}
                        </a>
                        <ul class="dropdown-menu" style="right: 0; left: unset;">
                            @foreach($menu->children as $child)
                                <li><a class="dropdown-item" href="{{$child->value}}">{{$child->menu_code}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>
