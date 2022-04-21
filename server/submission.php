<?php


$username = "jr550";
$password = "Wo0dabu9a";

$db_conn_str =
            "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                       (HOST = cedar.humboldt.edu)
                                       (PORT = 1521))
                            (CONNECT_DATA = (SID = STUDENT)))";

$conn = oci_connect($username, $password, $db_conn_str);

if (!$conn) {
    echo 'Error connecting...';
}


$req = json_decode($_POST['req']);

$props_query_str = '
        insert into scores
        values (
            :username,
            :q1,
            :q2,
            :q3,
            :q4,
            :q5,
            :q6,
            :score
            )
';


$props_query_stmt = oci_parse($conn, $props_query_str);


// bind vars passed from form to $_POST to query statement
oci_bind_by_name($props_query_stmt, ':username', $req->user);
oci_bind_by_name($props_query_stmt, ':q1', $req->answers[0]);
oci_bind_by_name($props_query_stmt, ':q2', $req->answers[1]);
oci_bind_by_name($props_query_stmt, ':q3', $req->answers[2]);
oci_bind_by_name($props_query_stmt, ':q4', $req->answers[3]);
oci_bind_by_name($props_query_stmt, ':q5', $req->answers[4]);
oci_bind_by_name($props_query_stmt, ':q6', $req->answers[5]);
oci_bind_by_name($props_query_stmt, ':score', $req->score);



// MUST USE 'OCI_COMMIT_ON_SUCCESS" OR YOUR INSERT WILL HAVE NO EFFECT!!!
oci_execute($props_query_stmt, OCI_COMMIT_ON_SUCCESS);

oci_free_statement($props_query_stmt);


oci_close($conn);



?>

