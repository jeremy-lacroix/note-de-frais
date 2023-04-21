<!-- BUTTON RETOUR -->
<div class="row pt-4 m-0">
    <div class="col-md-6 text-center">
        <button type="button" onclick="history.back()" class="btn btn-link"><i class="bi bi-arrow-left-circle-fill"></i> Retour</button>
    </div>
</div>

<!-- FORMULAIRE MODIFIER -->
<?php if (isset($_SESSION['vehicule'])) {?>

<div class="row w-100 mx-auto d-flex justify-content-center" style="min-height: 100vh!important">
    <div class="col-md-7 border rounded shadow my-md-3 my-2">
        <div class="row border" style="min-height: 11vh!important">
            <h4 class="text-left my-auto p-2 ml-3">Modifier un véhicule</h4>
        </div>
        
        <div class="row d-flex justify-content-center" style="min-height: 80vh!important">
            <div class="col-11 p-5 m-3">

                <form action="index.php?ctl=utilisateur&action=formmodifvehicule" method="post">
                    <!-- MARQUE -->
                    <div class="row p-1">
                        <div class="col-lg-6 text-center">
                            <h4>Marque</h4>
                        </div>
                        <div class="col-lg-6">
                            <input class="form-control shadow" type="text" name="marque" placeholder="Marque" value="<?php echo $_SESSION['vehicule'][0]?>" required>
                        </div>
                    </div>
                    <!-- MODELE -->
                    <div class="row p-1 mt-4">
                        <div class="col-lg-6 text-center">
                            <h4>Modèle</h4>
                        </div>
                        <div class="col-lg-6">
                            <input class="form-control shadow" type="text" name="modele" placeholder="Modèle" value="<?php echo $_SESSION['vehicule'][1]?>" required>
                        </div>
                    </div>
                    <!-- CARBURANT -->
                    <div class="row p-1 mt-4">
                        <div class="col-lg-6 text-center">
                            <h4>Carburant</h4>
                        </div>
                        <div class="col-lg-6">
                            <select name="carburant"class="form-control shadow">
                                <option <?php if ($_SESSION['vehicule'][2] == "Diesel") {echo "selected";}?> value="Diesel"> Diesel </option>
                                <option <?php if ($_SESSION['vehicule'][2] == "Essence") {echo "selected";}?> value="Essence">Essence</option>
                                <option <?php if ($_SESSION['vehicule'][2] == "Ethanol") {echo "selected";}?> value="Ethanol">Ethanol</option>
                                <option <?php if ($_SESSION['vehicule'][2] == "Electrique") {echo "selected";}?> value="Electrique">Electrique</option>
                            </select>
                        </div>
                    </div>
                    <!-- CYLINDRE -->
                    <div class="row p-1 mt-4">
                        <div class="col-lg-6 text-center">
                            <h4>Cylindre</h4>
                        </div>
                        <div class="col-lg-6">
                            <input class="form-control shadow" type="text" name="cylindre" placeholder="Cylindre" value="<?php echo $_SESSION['vehicule'][3]?>" required>
                        </div>
                    </div>
            </div>
                    <!-- SUBMIT -->
                    <input class="form-control btn btn-light border shadow my-auto m-5" type="submit" style="color: #1A4087;">
                </form>
        </div>
    </div>
</div>

<!-- FORMULAIRE AJOUT -->
<?php }else {?>
    <div class="row w-100 mx-auto d-flex justify-content-center" style="min-height: 100vh!important">
    <div class="col-md-7 border rounded shadow my-md-5">
        <div class="row border" style="min-height: 11vh!important">
            <h4 class="text-left my-auto p-2 ml-3">Ajouter un véhicule</h4>
        </div>
        
        <div class="row d-flex justify-content-center" style="min-height: 80vh!important">
            <div class="col-11 p-5 m-3">

                <form action="index.php?ctl=utilisateur&action=formajoutvehicule" method="post">
                    <!-- MARQUE -->
                    <div class="row p-1">
                        <div class="col-lg-6 text-center">
                            <h4>Marque</h4>
                        </div>
                        <div class="col-lg-6">
                            <input class="form-control shadow" type="text" name="marque" placeholder="Marque" required>
                        </div>
                    </div>
                    <!-- MODELE -->
                    <div class="row p-1 mt-4">
                        <div class="col-lg-6 text-center">
                            <h4>Modèle</h4>
                        </div>
                        <div class="col-lg-6">
                            <input class="form-control shadow" type="text" name="modele" placeholder="Modèle" required>
                        </div>
                    </div>
                    <!-- CARBURANT -->
                    <div class="row p-1 mt-4">
                        <div class="col-lg-6 text-center">
                            <h4>Carburant</h4>
                        </div>
                        <div class="col-lg-6">
                            <select name="carburant"class="form-control shadow">
                                <option value="Diesel">Diesel</option>
                                <option value="Essence">Essence</option>
                                <option value="Ethanol">Ethanol</option>
                                <option value="Electrique">Electrique</option>
                            </select>
                        </div>
                    </div>
                    <!-- CYLINDRE -->
                    <div class="row p-1 mt-4">
                        <div class="col-lg-6 text-center">
                            <h4>Cylindre</h4>
                        </div>
                        <div class="col-lg-6">
                            <input class="form-control shadow" type="text" name="cylindre" placeholder="Cylindre" required>
                        </div>
                    </div>
            </div>
                    <!-- SUBMIT -->
                    <input class="form-control btn btn-light border shadow my-auto m-5" type="submit" style="color: #1A4087;">
                </form>
        </div>
    </div>
</div>

<?php }?>