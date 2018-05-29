<?php
/* verification de connexion */
try{
    $db = new PDO('mysql:host=localhost;dbname=tuto', 'root', ''); 
    /* Activation des erreurs */
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING)
}catch(PDOException $e){
    echo 'Erreur de connexion a la base de donnée';
}

$sql = 'SELECT pseudo,mail FROM comments';
$req = $db->query($sql);
while($d = $req->fetch()){
    echo '<pre>';
    print_r($d);
    echo '</pre>';
}

/* 
PDO::FETCH_OBJ est la methode d'affichage
*/

while($d = $req->fetch(PDO::FETCH_OBJ)){
    echo '<pre>';
    print_r($d);
    echo '</pre>';
}

$sql = 'UPDATE comments SET pseudo="chien"';
$res = $db->exec($sql);
echo $res.' ligne(s) affectée(s)';

/* Methode Numerique classique*/
$d = array('Gael', 'monmail@gmail.com', 'gamingeek.fr');
$req = $db->prepare('INSERT INTO comments (pseudo,mail,content) VALUE (? , ? , ?)')
$req->execute($d);

/* Nommons ces variables*/ 
$d = array(
    'pseudo' => 'Gael', 
    'mail' => 'monmail@gmail.com', 
    'content' => 'gamingeek.fr'
);
$req = $db->prepare('INSERT INTO comments (pseudo,mail,content) VALUE (::pseudo , ::mail , ::content)')
$req->execute($d);

/*associatif et foreach */
$d = array(array(
        'pseudo' => 'Gael', 
        'mail' => 'monmail@gmail.com', 
        'content' => 'gamingeek.fr'
        )array(
        'pseudo' => 'monPSeudo', 
        'mail' => 'mail@gmail.com', 
        'content' => 'gamingeek.fr'
    )
);
foreach($d as $v){
    $req->execute($v);
}

/* systeme de transaction (ne fonctionne pas avec MyISAM) */
$db->beginTransaction();
$db->exec('UPDATE comments SET pseudo="test"');
$db->commit(); /* Pour valider la requete */
$db->rollback(); /* Pour annuler la requete */
?>
