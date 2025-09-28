  <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="/" class="app-brand-link">
        <span class="app-brand-logo demo pl-2">
          <img src="{{ asset('assets/img/logo/e.png')}}" style="width: 40px; margin-left:30px" alt="">
        </span>
        <span class="app-brand-text demo menu-text fw-bolder ms-2">
          <img src="{{ asset('assets/img/logo/sakip.png')}}"  style="width: 80px;" alt="">
        </span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">CCTV Kuningan</span>
    </li>
    @foreach($locations as $loc)
    <ul class="menu-inner py-1">
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">{{ $loc->nama }}</div>
            </a>
            <ul class="menu-sub">
                @forelse($loc->camera as $cam)
                    <li class="menu-item">
                        <a onclick="showCameraModal({{ $cam->id }})" class="menu-link">
                            <div>{{ $cam->name }}</div>
                        </a>
                    </li>
                @empty
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link">
                            <div><em>Tidak ada kamera</em></div>
                        </a>
                    </li>
                @endforelse
            </ul>
        </li>
      </ul>
      @endforeach
</aside>