<footer class="footer-copyright text-center py-3 ft">
      <span class="piet">
      @if(session()->get('supermarket_id') >= 1)
              {{ session()->get('supermarket_name_s') }}
          @else
          JET
      @endif
      </span>
  <div class="clearfix"></div>
</footer>
