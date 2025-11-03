<header id="header" class="header sticky-top">

  <div class="topbar d-flex align-items-center dark-background">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center">
          <a href="mailto:{{ $contact->email ?? '-' }}">{{ $contact->email ?? '-' }}</a>
        </i>
        <i class="bi bi-phone d-flex align-items-center ms-4">
          <span>{{ $contact->phone ?? '-' }}</span>
        </i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        @if($contact->instagram)
            <a href="{{ $contact->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>
        @endif
        @if($contact->linkedin)
            <a href="{{ $contact->linkedin }}" target="_blank"><i class="bi bi-linkedin"></i></a>
        @endif
      </div>
    </div>
  </div>

  <div class="branding d-flex align-items-center">
    <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/img/CV AS.png') }}" alt="Flexor Logo" class="img-fluid" style="height: 40px;">
        </a>


      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('user.home') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
          <li><a href="{{ request()->is('/') ? '#about' : route('user.home') . '#about' }}">About</a></li>
          <li><a href="{{ request()->is('/') ? '#solutions' : route('user.home') . '#solutions' }}" class="{{ request()->is('solutions') || request()->is('solutions/*') ? 'active' : '' }}">Solutions</a></li>
          <li><a href="{{ request()->is('/') ? '#project' : route('user.home') . '#project' }}" class="{{ request()->is('project') ? 'active' : '' }}">Project</a></li>
          <li><a href="{{ request()->is('/') ? '#team' : route('user.home') . '#team' }}">Team</a></li>
          {{-- <li class="dropdown">
            <a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown">
                <a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li> --}}
          <li><a href="{{ request()->is('/') ? '#contact' : route('user.home') . '#contact' }}">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </div>
</header>
