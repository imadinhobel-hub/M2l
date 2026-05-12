<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>

    <main>
        <div class="texteAccueil admin-page">
            <h1><span>Administration des ligues et des clubs</span></h1>

            <nav class="admin-nav" aria-label="Navigation administration">
                <a href="index.php?m2lMP=admin&section=ligues" class="<?= $section === 'ligues' ? 'is-active' : '' ?>">Gerer les ligues</a>
                <a href="index.php?m2lMP=admin&section=clubs" class="<?= $section === 'clubs' ? 'is-active' : '' ?>">Gerer les clubs</a>
                <a href="index.php?m2lMP=ligues">Retour a la liste publique</a>
            </nav>

            <?php if (!empty($messageAdmin)): ?>
                <p class="admin-message"><strong><?= htmlspecialchars($messageAdmin) ?></strong></p>
            <?php endif; ?>

            <?php if ($section === 'ligues'): ?>
                <section class="admin-panel">
                    <h2><?= $ligueEnEdition ? 'Modifier une ligue' : 'Ajouter une ligue' ?></h2>

                    <form class="admin-form" method="post" action="index.php?m2lMP=<?= $ligueEnEdition ? 'modifierLigue&id=' . (int) $ligueEnEdition['idLigue'] : 'ajouterLigue' ?>">
                    <?php if ($ligueEnEdition): ?>
                        <input type="hidden" name="id" value="<?= (int) $ligueEnEdition['idLigue'] ?>">
                    <?php endif; ?>

                    <p>
                        <label for="nom">Nom</label><br>
                        <input type="text" id="nom" name="nom" required value="<?= htmlspecialchars($ligueEnEdition['nomLigue'] ?? '') ?>">
                    </p>

                    <p>
                        <label for="site">Site</label><br>
                        <input type="text" id="site" name="site" value="<?= htmlspecialchars($ligueEnEdition['site'] ?? '') ?>">
                    </p>

                    <p class="field-wide">
                        <label for="descriptif">Descriptif</label><br>
                        <textarea id="descriptif" name="descriptif" rows="4" cols="60"><?= htmlspecialchars($ligueEnEdition['descriptif'] ?? '') ?></textarea>
                    </p>

                    <p class="form-actions">
                        <button type="submit"><?= $ligueEnEdition ? 'Enregistrer' : 'Ajouter' ?></button>
                        <?php if ($ligueEnEdition): ?>
                            <a href="index.php?m2lMP=admin&section=ligues">Annuler</a>
                        <?php endif; ?>
                    </p>
                    </form>
                </section>

                <section class="admin-panel admin-panel-wide">
                    <h2>Liste des ligues</h2>
                    <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Site</th>
                            <th>Descriptif</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ligues as $ligue): ?>
                            <tr>
                                <td><?= (int) $ligue['idLigue'] ?></td>
                                <td><?= htmlspecialchars($ligue['nomLigue']) ?></td>
                                <td><?= htmlspecialchars($ligue['site']) ?></td>
                                <td><?= htmlspecialchars($ligue['descriptif']) ?></td>
                                <td class="actions">
                                    <a class="action-edit" href="index.php?m2lMP=modifierLigue&id=<?= (int) $ligue['idLigue'] ?>">Modifier</a>
                                    |
                                    <a class="action-delete" href="index.php?m2lMP=supprimerLigue&id=<?= (int) $ligue['idLigue'] ?>" onclick="return confirm('Supprimer cette ligue ?');">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                    </div>
                </section>
            <?php endif; ?>

            <?php if ($section === 'clubs'): ?>
                <section class="admin-panel">
                    <h2><?= $clubEnEdition ? 'Modifier un club' : 'Ajouter un club' ?></h2>

                    <form class="admin-form" method="post" action="index.php?m2lMP=<?= $clubEnEdition ? 'modifierClub&id=' . (int) $clubEnEdition['idClub'] : 'ajouterClub' ?>">
                    <?php if ($clubEnEdition): ?>
                        <input type="hidden" name="id" value="<?= (int) $clubEnEdition['idClub'] ?>">
                    <?php endif; ?>

                    <p>
                        <label for="nomClub">Nom</label><br>
                        <input type="text" id="nomClub" name="nom" required value="<?= htmlspecialchars($clubEnEdition['nomClub'] ?? '') ?>">
                    </p>

                    <p>
                        <label for="adresse">Adresse</label><br>
                        <input type="text" id="adresse" name="adresse" required value="<?= htmlspecialchars($clubEnEdition['adresseClub'] ?? '') ?>">
                    </p>

                    <p>
                        <label for="idCommune">Commune</label><br>
                        <select id="idCommune" name="idCommune" required>
                            <option value="">Choisir une commune</option>
                            <?php foreach ($communes as $commune): ?>
                                <option value="<?= (int) $commune['idCommune'] ?>" <?= isset($clubEnEdition['idCommune']) && (int) $clubEnEdition['idCommune'] === (int) $commune['idCommune'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($commune['nomCommune']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </p>

                    <p>
                        <label for="idLigue">Ligue</label><br>
                        <select id="idLigue" name="idLigue" required>
                            <option value="">Choisir une ligue</option>
                            <?php foreach ($ligues as $ligue): ?>
                                <option value="<?= (int) $ligue['idLigue'] ?>" <?= isset($clubEnEdition['idLigue']) && (int) $clubEnEdition['idLigue'] === (int) $ligue['idLigue'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($ligue['nomLigue']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </p>

                    <p class="form-actions">
                        <button type="submit"><?= $clubEnEdition ? 'Enregistrer' : 'Ajouter' ?></button>
                        <?php if ($clubEnEdition): ?>
                            <a href="index.php?m2lMP=admin&section=clubs">Annuler</a>
                        <?php endif; ?>
                    </p>
                    </form>
                </section>

                <section class="admin-panel admin-panel-wide">
                    <h2>Liste des clubs</h2>
                    <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Adresse</th>
                            <th>Commune</th>
                            <th>Ligue</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clubs as $club): ?>
                            <tr>
                                <td><?= (int) $club['idClub'] ?></td>
                                <td><?= htmlspecialchars($club['nomClub']) ?></td>
                                <td><?= htmlspecialchars($club['adresseClub']) ?></td>
                                <td><?= htmlspecialchars($club['nomCommune']) ?></td>
                                <td><?= htmlspecialchars($club['nomLigue']) ?></td>
                                <td class="actions">
                                    <a class="action-edit" href="index.php?m2lMP=modifierClub&id=<?= (int) $club['idClub'] ?>">Modifier</a>
                                    |
                                    <a class="action-delete" href="index.php?m2lMP=supprimerClub&id=<?= (int) $club['idClub'] ?>" onclick="return confirm('Supprimer ce club ?');">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                    </div>
                </section>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>
