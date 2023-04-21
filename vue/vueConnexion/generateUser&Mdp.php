<div class="row h-100 mx-3">
   <div class="col-lg-4 mx-auto mb-auto rounded border shadow p-3 align-middle" style="color: #1A4087; margin-top : 15vh!important;">
      <h1 class="text-center mt-3">Entrer votre E-mail</h1>
      
      <form class="fluid-form text-center" action="index.php?ctl=insertAllUsers&action=ImportAndCreateUser" method="POST" enctype="multipart/form-data">
         <div class="mb-3">
            <label for="formFile" class="form-label">Importez la liste des users</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="20000">
            <input class="form-control" type="file" name="file">
            <button type="submit" name="import" class="btn btn-primary mt-2">Insérez</button>
         </div>
      </form>
   </div>
</div>