<?php include 'header.php' ?>

  <div class="container">

    <div class="row">
      <div class="span4 offset4 well">

        <legend>Register Account</legend>

        <?php if (isset($error) && $error): ?>
          <div class="alert alert-error">
            <a class="close" data-dismiss="alert" href="#">×</a>Incorrect Username or Password!
          </div>
        <?php endif; ?>

        <?php echo form_open('register/register_user') ?>

        <b>Firstame</b><br />
        <input type="text" id="firstname" class="span4" name="firstname"><br />
        <br />
        <b>Lastname</b><br />
        <input type="text" id="lastname" class="span4" name="lastname"><br />
        <br />
        <b>E-mail</b><br />
        <input type="text" id="email" class="span4" name="email" placeholder="Email Address"><br />
        <br />
        <b>Password</b><br />
        <input type="password" id="password" class="span4" name="password" placeholder="Password"><br />
        <br />
        <b>Repeat password</b><br />
        <input type="password" id="password_repeat" class="span4" name="password_repeat" placeholder="Password"><br />
        <br />
        <b>Unique ID</b><br />
        <input type="text" id="unique_id" class="span4" name="unique_id"><br />
        <br />

        <!--<label class="checkbox">
          <input type="checkbox" name="remember" value="1"> Remember Me
        </label>-->

        <button type="submit" name="submit" class="btn btn-info">Sign me up!</button>

        </form>
      </div>
    </div>
  </div>

<?php include 'footer.php' ?>