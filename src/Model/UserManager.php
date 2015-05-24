<?php
/**
 * Created by PhpStorm.
 * User: TaF
 * Date: 12/05/2015
 * Time: 10:16
 */

namespace Taf\Model;


class UserManager {

    protected $db;

    function __construct($connection) {
        $this->db = $connection;
    }
    function create_user($login, $pass)
    {

        //requete pour recupéré les info des comptes.
        $response = $this->db->query('SELECT pseudo FROM users');


        //verify if username already exist.
        while ($data = $response->fetch()) {
            foreach ($data AS $user) {
                if ($user == $login) {
                    echo "Ce nom d'utilisateur existe déjà. Veuillez en choisir un autre.";
                    exit;
                }
            }
        }
        //cryptage password en SHA-1 (METTRE A JOUR EN SELL).

        $password_crypt = sha1($pass);


        //requete preparé et exécution pour add pseudo et password dans la db.
        $req = $this->db->prepare("INSERT INTO users (pseudo, password) VALUES (:pseudo, :password)");

        //bind des paramètre pour que SQL fasse les vérification de validité des chaine envoyées.

        $req->execute([
            'pseudo' => $login,
            'password' => $password_crypt,
        ]);

        echo "Votre compte à été crée";


    }

    //funcion for users connection.
    function connect_user($login, $password)
    {
        //use SHA-1 on password to crypt it.
        $password_crypt = sha1($password);


        //requete pour recupéré les info des comptes.
        $response = $this->db->query('SELECT id, pseudo, password FROM users');
        //return $response;

        //verify if connect information is correct, if yes, create a Session.
        //Load home page when user login successful
        while ($data = $response->fetch()) {
            echo "test";
            if ($data['pseudo'] == $login && $data['password'] == $password_crypt) {
                $_SESSION['member'] = $login;
                $_SESSION['member_id'] = $data['id'];
                header('Location: ./index.php?page=home');
                exit;
            }
        }

    }



}