<?php
require_once __DIR__.'/UserModel.php';
/**
 *
 */
class AccountModel extends UserModel
{
    /**
     * Renvoie un utilisateur a partir de  son login
     * @param string $loginUtilisateur
     * @return null
     * @throws \dFramework\core\exception\Exception
     */
    public function getUser(string $key, string $value)
    {
        return $this
            ->free_db()
            ->select()
            ->from('Utilisateurs')
            ->where($key.' = ?')->params([$value])
            ->first();
    }


    public function logout($id_utilisateur)
    {
        // Localisation du fichier de log des users
        $filename = RESOURCE_DIR.'userlog.json';

        // Contenu du fichier
        $content = file_get_contents($filename);
        $content = json_decode($content, true);

        // Suppression de l'utilisateur de la liste des user connectes
        unset($content[md5($id_utilisateur)]);

        // encodage des donnees au format JSON
        $content = json_encode($content, JSON_PRETTY_PRINT);

        file_put_contents($filename, $content);
    }

    public function login($id_utilisateur, $ip, $user_agent)
    {
        $this->logout($id_utilisateur);

        // Localisation du fichier de log des users
        $filename = RESOURCE_DIR.'userlog.json';

        // Ressource
        $content = file_get_contents($filename);

        $content = json_decode($content, true);

        // Renplacement de l'ip de l'utilisateur
        $content[md5($id_utilisateur)] = [md5($ip), $user_agent];

        // encodage des donnees au format JSON
        $content = json_encode($content, JSON_PRETTY_PRINT);

        file_put_contents($filename, $content);
    }

    public function checkconnected($id_utilisateur, $ip, $user_agent)
    {
        // on admet que l'utilisateur est connecter
        $is_connected = true;

        // Localisation du fichier de log des users
        $filename = RESOURCE_DIR.'userlog.json';
        // Contenu du fichier
        $content = file_get_contents($filename);
        $content = json_decode($content, true);

        // On recupere les infos de connexion de l'utilisateur
        $user = $content[md5($id_utilisateur)] ?? null;

        if(empty($user) OR count($user) != 2) {
            $is_connected = false;
        }
        else if (md5($ip) !== $user[0] OR $user_agent !== $user[1]) {
            $is_connected = false;
        }

        return $is_connected;
    }
}
