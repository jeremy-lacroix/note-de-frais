<div class="row w-100 mx-auto d-flex justify-content-center mt-3" style="min-height : 71vh!important;">
    <!-- CARD BOX -->
    <div class="col-md-7    border rounded shadow my-md-5">
        <!-- TITRE -->
        <div class="row border" style="min-height : 11vh!important;">
            <h4 class="text-left my-auto p-2 ml-3">Historique</h4>
        </div>
        <div class="row text-center" style="min-height : 60vh!important;">
            <div class="mt-3 mx-5">
                <div class="row">
                    <i style="font-size : 3em; color: #1A4087;" class="bi bi-person-circle"></i>
                </div>
                <div class="row">
                    <h4 class="my-4">Nom : <?php echo $_SESSION['nom'] ?></h4>
                </div>
                <div class="row">
                    <h4 class="my-4">Prénom : <?php echo $_SESSION['prenom'] ?></h4>
                </div>
                <div class="row">
                    <h4 class="my-4">Matricule : <?php echo $_SESSION['matricule'] ?></h4>
                </div>
                <?php if(isset($_SESSION['vehicule'])){ ?>
                <div class="row">
                    <h4 class="my-4">Véhicule : <?php echo $_SESSION['vehicule'][0]," ", $_SESSION['vehicule'][1] ?> <a href="index.php?ctl=utilisateur&action=formvehicule" class="btn btn-primary">Modifier</a> </h4>
                </div>
                <?php } else {?>
                <form action="index.php?ctl=utilisateur&action=formvehicule" method="POST" class="fluid-form">
                    <input type="submit" value="Saisir véhicule">
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>