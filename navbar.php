	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #A62D38;">
  <a class="navbar-brand" href="index"><img src="plugin/design/officialseal.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto w-100 justify-content-end">
      <li class="nav-item <?php if($nav=='index'){echo 'active';}?>">
        <a class="nav-link" href="index">Home</a>
      </li>
      <li class="nav-item <?php if($nav=='application'){echo 'active';}?>">
        <a class="nav-link" href="option">Be a Lycean</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#loginModal" data-toggle="modal">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#entranceModal" data-toggle="modal">Exam</a>
      </li>
    </ul>
  </div>
</nav>