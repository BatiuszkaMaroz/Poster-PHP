<nav>
  <div class="row">
    <div class="offset-s1 col s10">
      <div class="nav-wrapper">
        <a href="/poster/" class="brand-logo">Poster</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <?php
          require(dirname(__FILE__) . "/links.php");
          ?>
        </ul>
      </div>
    </div>
  </div>
</nav>

<ul class="sidenav center" id="mobile-demo">
  <?php
  require(dirname(__FILE__) . "/links.php");
  ?>
</ul>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elms = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elms);
  });
</script>