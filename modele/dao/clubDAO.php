<?php
include_once __DIR__ . '/param.php';
include_once __DIR__ . '/dBConnex.php';

class ClubDAO {

    // 🔍 Récupérer tous les clubs
    public static function getAllClubs(): array {
        $db = DBConnex::getInstance();
        $query = $db->prepare("SELECT * FROM club");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔍 Récupérer tous les clubs via la vue v_clubs
    public static function getAllClubViewers(): array {
        $db = DBConnex::getInstance();
        $query = $db->prepare("SELECT * FROM v_clubs");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllClubsWithDetails(): array {
        $db = DBConnex::getInstance();
        $query = $db->prepare(
            "SELECT c.idClub, c.nomClub, c.adresseClub, c.idCommune, c.idLigue, co.nomCommune, l.nomLigue
             FROM club c
             INNER JOIN commune co ON c.idCommune = co.idCommune
             INNER JOIN ligue l ON c.idLigue = l.idLigue
             ORDER BY c.nomClub"
        );
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔍 Récupérer les clubs d'une ligue
    public static function getClubsByLigue($idLigue): array {
        $db = DBConnex::getInstance();
        $query = $db->prepare("SELECT * FROM club WHERE idLigue = ?");
        $query->execute([$idLigue]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔍 Récupérer les clubs d'une ligue via la vue
    public static function getClubsByLigueViewers($idLigue): array {
        $db = DBConnex::getInstance();
        $query = $db->prepare("SELECT * FROM v_clubs WHERE idLigue = ?");
        $query->execute([$idLigue]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔍 Rechercher des clubs par nom
    public static function searchClubs($searchTerm): array {
        $db = DBConnex::getInstance();
        $query = $db->prepare("SELECT * FROM club WHERE nomClub LIKE ?");
        $query->execute(["%" . $searchTerm . "%"]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔍 Récupérer un club par son ID
    public static function getClubById($id) {
        $db = DBConnex::getInstance();
        $query = $db->prepare("SELECT * FROM club WHERE idClub = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // ➕ Ajouter un club
    public static function createClub($nom, $adresse, $idCommune, $idLigue) {
        $db = DBConnex::getInstance();

        // Vérification commune
        $checkCommune = $db->prepare("SELECT COUNT(*) FROM commune WHERE idCommune = ?");
        $checkCommune->execute([$idCommune]);
        if ($checkCommune->fetchColumn() == 0) {
            throw new Exception("Commune introuvable.");
        }

        // Vérification ligue
        $checkLigue = $db->prepare("SELECT COUNT(*) FROM ligue WHERE idLigue = ?");
        $checkLigue->execute([$idLigue]);
        if ($checkLigue->fetchColumn() == 0) {
            throw new Exception("Ligue introuvable.");
        }

        // Insertion
        $insert = $db->prepare("INSERT INTO club (nomClub, adresseClub, idCommune, idLigue) VALUES (?, ?, ?, ?)");
        $insert->execute([$nom, $adresse, $idCommune, $idLigue]);
    }

    // ✏️ Modifier un club
    public static function updateClub($idClub, $nomClub, $adresseClub, $idCommune, $idLigue) {
        $db = DBConnex::getInstance();
        $update = $db->prepare("UPDATE club SET nomClub = ?, adresseClub = ?, idCommune = ?, idLigue = ? WHERE idClub = ?");
        return $update->execute([$nomClub, $adresseClub, $idCommune, $idLigue, $idClub]);
    }

    // ❌ Supprimer un club
    public static function deleteClub($idClub) {
        $db = DBConnex::getInstance();
        $delete = $db->prepare("DELETE FROM club WHERE idClub = ?");
        return $delete->execute([$idClub]);
    }

    // 📍 Récupérer toutes les communes
    public static function getAllCommunes(): array {
        $db = DBConnex::getInstance();
        $query = $db->prepare("SELECT idCommune, nomCommune FROM commune ORDER BY nomCommune");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
