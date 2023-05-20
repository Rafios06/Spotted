<?php

function generateSelectReceivers()
{
    require("checkconnect.php");
    require("configsql.php");

    // Open a connection to a MySQL Server
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    if ($stmt = $con->prepare("SELECT * FROM receiver WHERE Receiver_Owner_ID = '" . $_SESSION['login'] . "'")) {
        $stmt->execute();
        $stmt->store_result();

        do {
            $stmt->bind_result($id, $account_status, $username, $password, $api_key);
            if(!empty($id)){
                echo '<tr>
                <th scope="row">'.$id.'</th>';
                if($account_status == $status_admin_user){
                    echo '<td class="text-danger fw-bold text-break">'.htmlentities($username, ENT_QUOTES, 'UTF-8').'</td>';
                } else {
                    echo '<td>'.htmlentities($username, ENT_QUOTES, 'UTF-8').'</td>';
                }
                echo '<td class="text-break"><div class="input-group input-group-sm"><input class="form-control" type="text" aria-label="API_KEY" value="'.$api_key.'"></div></td>
                <td><a href="search.php?se='.$username.'" class="card-link"><span class="mb-0 btn btn-sm btn-outline-dark">&#128269;</span></a>
                <a href="daaccount.php?id='.$id.'" class="card-link"><span class="mb-0 btn btn-sm btn-outline-danger">&#128465;</span></a></td>
                </tr>';
            }
        } while ($row = $stmt->fetch());
    } else {
        echo '';
    }

    $stmt->close();
    return '';
}
