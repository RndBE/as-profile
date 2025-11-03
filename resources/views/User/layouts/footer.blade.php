<footer id="footer" class="footer light-background">
  <div class="container footer-top">
    <div class="row gy-4 justify-content-between align-items-start">
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
            <img loading="lazy" src="{{ asset('assets/img/CV AS.png') }}" alt="Flexor Logo" class="img-fluid" style="height: 40px;">
        </a>
        <div class="footer-contact pt-2">
          <p>{{ $contact->alamat ?? 'Alamat belum diatur' }}</p>
          <p class="mt-3"><strong>Phone:</strong> <span>{{ $contact->phone ?? '-' }}</span></p>
          <p><strong>Email:</strong> <span>{{ $contact->email ?? '-' }}</span></p>
        </div>
        @if($contact)
        <div class="social-links d-flex mt-4">
          @if($contact->instagram)
            <a href="{{ $contact->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>
          @endif
          @if($contact->linkedin)
            <a href="{{ $contact->linkedin }}" target="_blank"><i class="bi bi-linkedin"></i></a>
          @endif
        </div>
        @endif
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Useful Links</h4>
        <ul>
          <li><a href="{{ route('user.home') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
          <li><a href="{{ request()->is('/') ? '#about' : route('user.home') . '#about' }}">About us</a></li>
          <li><a href="{{ request()->is('/') ? '#solutions' : route('user.home') . '#solutions' }}">Solutions</a></li>
          <li><a href="#">Terms of service</a></li>
          <li><a href="#">Privacy policy</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Our Services</h4>
        <ul>
          <li><a href="#">Industrial Data Logger</a></li>
          <li><a href="#">IoT Monitoring System</a></li>
          <li><a href="#">Web Dashboard Integration</a></li>
          <li><a href="#">Custom Software Development</a></li>
          <li><a href="#">Technical Support & Maintenance</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container copyright text-center mt-4">
    <p>© <span>Copyright</span>
      <strong class="px-1 sitename">2025 CV Arta Solusindo</strong>
      <span>All Rights Reserved</span>
    </p>
    <div class="credits">
      Designed by <a href="#">CV Arta Solusindo Team</a>
    </div>
  </div>
</footer>
