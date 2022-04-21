<?php

$username = "jr550";
$password = "Wo0dabu9a";


$db_conn_str =
            "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                       (HOST = cedar.humboldt.edu)
                                       (PORT = 1521))
                            (CONNECT_DATA = (SID = STUDENT)))";


// Connect to DB
$conn = oci_connect($username, $password, $db_conn_str);

if (!$conn) {
    echo 'Error connecting...';
}


// Drop table if exists
$create_table_str = "
drop table scores
";

$create_table_stmt = oci_parse($conn, $create_table_str);

oci_execute($create_table_stmt, OCI_COMMIT_ON_SUCCESS);

oci_free_statement($create_table_stmt);




// Create table
$create_table_str = "
    create table scores(
        username varchar(30),
        q1 varchar(30),
        q2 varchar(30),
        q3 varchar(30),
        q4 varchar(30),
        q5 varchar(30),
        q6 varchar(30),
        score number
    )
";

$create_table_stmt = oci_parse($conn, $create_table_str);

oci_execute($create_table_stmt, OCI_COMMIT_ON_SUCCESS);

oci_free_statement($create_table_stmt);

echo 'Table Created/Cleared!';

oci_close($conn);


?>
