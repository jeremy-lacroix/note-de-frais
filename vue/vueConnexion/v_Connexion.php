<div class="row h-75 mx-3">
   <div class="col-lg-4 mx-auto mb-auto rounded border shadow p-3 align-middle" style="color: #1A4087; margin-top : 15vh!important;">
      <h1 class="text-center mt-3">CONNEXION</h1>
      <form class="fluid-form text-center" action="index.php?ctl=connection&action=formConnect" method="post">
         <input class="form-control mt-5 shadow" type="email" name="email" placeholder="Email" required style="color: #1A4087;">
         <input class="form-control mt-2 shadow" type="password" name="password" placeholder="Mot de passe" required style="color: #1A4087;">
         <?php
         if (!empty(DbConnection::verifyUserConnection())) {
            echo '<h6 class="alert alert-danger text-center" role="alert">' . DbConnection::verifyUserConnection() . '</h6>';
         }
         ?>
         <input class="form-control btn btn-light mt-5 border w-75 shadow" type="submit" style="color: #1A4087;" name="validate">
      </form>
      <!-- Button import alls_users -->
      <!-- <div class="text-center mt-3">
         <a class="form-control btn btn-light border w-75 shadow" role="button" style="color: #1A4087;" href="index.php?ctl=connection&action=connect">import all_users</a>
      </div> -->
   </div>

</div>