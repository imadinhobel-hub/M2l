<?php
require_once 'param.php';

class UtilisateurDAO {

    public static function verifierIdentifiants($login, $motDePasse) {
        try {
            $pdo = new PDO(Param::$dsn, Param::$user, Param::$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE login = :login");
            $stmt->bindParam(':login', $login);
            $stmt->execute();

            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($utilisateur) {
                $motDePasseStocke = $utilisateur['mdp'];

                // Accepte les anciens mots de passe en clair et les mots de passe hashés.
                if ($motDePasse === $motDePasseStocke || password_verify($motDePasse, $motDePasseStocke)) {
                    return $utilisateur;
                }
            }

            return false;

        } catch (PDOException $e) {
            return false;
        }
    }
}
