   <!-- Sidebar start  -->
   <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <a class="nav-link" href="{{ route('dashboard.index') }}">
            <div class="sb-nav-link-icon">
              <i class="fas fa-tachometer-alt"></i>
            </div>
            myDashboard
          </a>

          <a class="nav-link" href="{{ route('dashboard.addtracker') }}">
            <div class="sb-nav-link-icon">
              <i class="fas fa-plus"></i>
            </div>
            Add Tracker
          </a>

          <a class="nav-link" href="{{ route('dashboard.setting') }}">
            <div class="sb-nav-link-icon">
              <i class="fa fa-cog" aria-hidden="true"></i>
            </div>
            Setting
          </a>
          <a class="nav-link" href="{{ route('dashboard.support') }}">
            <div class="sb-nav-link-icon">
              <i class="fa-solid fa-circle-info"></i>
            </div>
            Support
          </a>
          <a class="nav-link" href="{{ route('dashboard.payment') }}">
            <div class="sb-nav-link-icon">
              <i class="fa-solid fa-credit-card"></i>
            </div>
            Payment
          </a>
          <!-- <a class="nav-link" href="terms.html">
            <div class="sb-nav-link-icon">
              <i class="fa-regular fa-file-lines"></i>
            </div>
            Terms & Conditions
          </a>
          <a class="nav-link" href="privacy-policy.html">
            <div class="sb-nav-link-icon">
              <i class="fa-solid fa-shield-halved"></i>
            </div>
            Privacy & Policy
          </a> -->
        </div>
      </div>
      <div class="footer_logo p-4">
        <img
          src="{{asset('build/assets/assets/img/dashboardlogo.png')}}"
          alt=""
          class="img-fluid"
        />
      </div>
      <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        Mark Wood
      </div>
    </nav>
  </div>
  <!-- Sidebar End  -->
