<?
    include_once('top.php');

    if (!$gAuthUser) { header('Location: index.php'); }

//sessions

    $user_id = $_SESSION['UserInfoId'];
    $session_id = session_id();

    echo 'user_id = '.$user_id.'</br>';
    echo 'session_id = '.$session_id.'</br>';

//db

    $file_name = 'test.jpg';

//add picture

	$gDb->query('INSERT INTO '.TB.'users_gallery (uid, name) VALUES (?,?) ', array($user_id, $file_name));

	echo 'inserted...'.'</br>';;

// delete picture

	$gDb->query("DELETE FROM ".TB."users_gallery WHERE name = '$file_name'");

	echo 'deleted....'.'</br>';
?>
