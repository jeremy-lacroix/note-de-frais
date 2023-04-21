<br>
<br>
<div class="container-fluid" style="min-height : 71vh!important;">
    <div class="row ">
        <table class="table table-striped table-responsive-sm my-5 mx-5">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col" colspan="3">Prénoms</th>
                    <th scope="col-5">Total note</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>


            <!-- Liste des utilisateurs -->
            <?php foreach ($listeAllUsers as $listeUsers => $listeAllUser) : ?>
                <!-- Declare variable ID -->
                <?php $id_users = $listeAllUser['Id'] ?>
                <thead>
                    <!-- Nom et donner note de frais user -->
                    <tr style="background-color: #7a7a7a ;">
                        <th scope="row">
                            <button class="btn btn-primary rounded-circle" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample<?= $id_users ?>" aria-expanded="false" aria-controls="collapseExample<?= $id_users ?>">
                                <i class="bi bi-arrow-down-circle"></i>
                            </button>
                        </th>
                        <th class="text-white"><?= $Nom = $listeAllUser['Nom']  ?></th>
                        <th class="text-white" colspan="3"><?= $Nom = $listeAllUser['Prenom']  ?></th>
                        <th class="text-white"></th>
                        <th class="text-white"></th>
                        <th class="text-white"></th>
                        <!-- Button SUPP and ACCP -->
                        <th class="text-center">
                            <button type="button" class="btn btn-dange"></button>
                            <button type="button" class="btn btn-succes"></button>
                        </th>
                    </tr>
                </thead>

                <!-- Mission Users -->
                <?php foreach ($MissionUsers as $Mission => $MissionUser) : ?>
                    <?php if ($id_users === $MissionUser['Id_Utilisateur']) : ?>
                        <!-- Declare variable ID -->
                        <?php $id_mission = $MissionUser['Id_ndf'] ?>
                        <thead class="collapse" id="collapseExample<?= $id_users ?>">
                            <!-- Nom et donner note de frais user -->
                            <tr style="background-color: #0066ff ;">
                                <th>
                                    <button class="btn btn-primary rounded-circle" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2<?= $id_mission ?>" aria-expanded="false" aria-controls="collapseExample2<?= $id_mission ?>">
                                        <i class="bi bi-plus-circle"></i>
                                    </button>
                                </th>
                                <th class="text-white"></th>
                                <th class="text-white" colspan="3"><?= $Mission = $MissionUser['Mission']  ?></th>
                                <th class="text-white"><?= $MissionUser['Date'] ?></th>
                                <th class="text-white"></th>
                                <th class="text-white">Description</th>
                                <!-- Button SUPP and ACCP -->
                                <th class="text-center">
                                    <button type="button" class="btn btn-danger">Refuser tout</button>
                                    <button type="button" class="btn btn-success">Accepter tout</button>
                                </th>
                            </tr>
                        </thead>

                        <!-- start second partie table -->

                        <!-- Deuxième tableau pour détail note de frais User -->
                        <thead class="collapse" id="collapseExample2<?= $id_mission ?>">
                            <tr>
                                <td scope="row"></td>
                                <td class="font-weight-light font-italic"></td>
                                <td class="font-weight-light font-italic">Libélé</td>
                                <td class="font-weight-light font-italic"></td>
                                <td class="font-weight-light font-italic">Date</td>
                                <td class="font-weight-light font-italic">Total réglé</td>
                                <td class="font-weight-light font-italic">Statuts</td>
                                <td class="font-weight-light font-italic"></td>
                                <td></td>
                            </tr>
                        </thead>

                        <!-- Ligne de note de frais -->
                        <?php foreach ($ligneNoteDeFraisUsers as $ligne => $ligneNoteDeFraisUser) : ?>
                            <?php if ($id_mission === $ligneNoteDeFraisUser['Id_ndf']) : ?>
                                <tbody class="collapse" id="collapseExample2<?= $id_mission ?>">
                                    <tr>
                                        <td scope="row"></td>
                                        <td></td>
                                        <td>
                                            <!-- Libélé du User -->
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1">Nom de truck</p>
                                                <p class="text-muted mb-0"><?= $ligneNoteDeFraisUser['Detail'] ?></p>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td><?= $ligneNoteDeFraisUser['Date'] ?></td>
                                        <td> <?= $montant = $ligneNoteDeFraisUser['Montant']; ?> </td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">
                                            <!-- Button libélé user -->
                                            <button type="button" class="btn btn-secondary btn-sm">Refuser</button>
                                            <button type="button" class="btn btn-success btn-sm">Accepter</button>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <!-- End table -->
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <!-- End table -->
        </table>
    </div>
</div>
<br>
<br>