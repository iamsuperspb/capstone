<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <img src="plugin/design/logo.png" style="width: 50px; height: 50px;"><h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Username:</label>
            <input type="text" class="form-control" name="username" required="">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Password:</label>
            <input type="password" class="form-control" name="password" required="">
          </div>
      </div>
      <div class="modal-footer">
      	<button type="submit" name="login_btn" class="btn btn-danger"><span data-feather="check-square"></span> Login</button>
        <button type="button" class="btn btn-dark" data-dismiss="modal"><span data-feather="x-square"></span> Close</button>
      </div>
    </div>
	</form>
  </div>
</div>