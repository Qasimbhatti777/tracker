<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
      <div
        class="d-flex align-items-center justify-content-between small"
      >
        <div class="text-muted">myCourtBot, LLC © 2023</div>
        <div>
          <a href="{{route('dashboard.privacy')}}">Privacy Policy</a>
          &middot;
          <a href="{{route('dashboard.terms')}}">Terms &amp; Conditions</a>
        </div>
      </div>
    </div>
  </footer>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
crossorigin="anonymous"
></script>
<script src="{{ asset('build/assets/js/scripts.js') }}"></script>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
crossorigin="anonymous"
></script>
<script src="{{asset('build/assets/assets/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('build/assets/assets/demo/chart-bar-demo.js')}}"></script>
<script
src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
crossorigin="anonymous"
></script>
@stack('script')
<script src="{{ asset('build/assets/js/datatables-simple-demo.js')}}"></script>
</body>
</html>
