SELECT
    u.login,
    u.mdp,
    u.statut_existant,
    p.nom,
    p.prenom,
    p.sexe,
    p.email,
    p.tel,
    requete1.id_utilisateur AS id_etudiant,
    requete2.id_utilisateur AS id_professeur,
    requete2.is_member_de,
    requete2.specialite,
    requete2.titre
FROM
    `utilisateurs` u
INNER JOIN profils p ON
    p.id_utilisateur = u.id_utilisateur
LEFT JOIN(
    SELECT
        e.*
    FROM
        etudiants AS e
    JOIN utilisateurs ON e.id_utilisateur = utilisateurs.id_utilisateur
) AS requete1
ON
    requete1.id_utilisateur = u.id_utilisateur
LEFT JOIN(
    SELECT
        pr.*
    FROM
        professeurs AS pr
    JOIN utilisateurs ON pr.id_utilisateur = utilisateurs.id_utilisateur
) AS requete2
ON
    requete2.id_utilisateur = u.id_utilisateur