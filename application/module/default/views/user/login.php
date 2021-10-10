<div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Sign In </h2>
    <h2 class="inactive underlineHover">Sign Up </h2>

    <!-- Icon -->


    <!-- Login Form -->

    <form action="../controllers/usercontroller.php" method="post">
      <input type="hidden" class="fadeIn second" name="login">
      <input type="text" class="fadeIn second" name="username" placeholder="login">
      <input type="text" class="fadeIn third" name="password" placeholder="password">
      <input type="submit" value="add" name="submit">
  </form>