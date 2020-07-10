
<hr>

<h3> Admin-Zone </h3>
<h4> Userverwaltung</h4>

<?php
// changes Status to selected Value, is new Value equal to old value, no changes are made
if (null !== (filter_input(INPUT_POST, "changeStatus"))) {
    if (filter_input(INPUT_POST, "oldStatus") === filter_input(INPUT_POST, "activeStatus")) {
        echo '<p style="color:red;">UserID "' . filter_input(INPUT_POST, "userId") . '" Status unverändert.</p>';
    } elseif (setIsActiveStatus(filter_input(INPUT_POST, "userId"), filter_input(INPUT_POST, "activeStatus"))) {
        if (filter_input(INPUT_POST, "activeStatus")) {
            echo '<p style="color:green;">UserID "' . filter_input(INPUT_POST, "userId") . '" Status auf <i>"aktiv"</i> gesetzt</p>';
        } else {
            echo '<p style="color:green;">UserID "' . filter_input(INPUT_POST, "userId") . '" Status auf <i>"inaktiv"</i> gesetzt</p>';
        }
    }
}



// Select on all User IDs, gets Array
$userList = getAllUsers();
?>

<!-- Collapsed List of all Users, shows their Pictures and can change active/inactive status -->
<div class="accordion" id="userverwaltung_admin">
    <?php
    foreach ($userList as $user) {
        $tempUserObject = getUserById($user);
        ?>

        <div class="card">
            <div class="card-header" id="editUserdataLabel">
                <h5 class="mb-0">
                    <?php
                    echo '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#editUserdata' . $tempUserObject->getUid() . '" aria-expanded="true">';
                    if ($tempUserObject->getIsActive()) {
                        echo 'ID: <b>' . $tempUserObject->getUid() . '</b> Username: <b>' . $tempUserObject->getUsername() . '</b> <i style="color:green;">active</i>';
                    } else {
                        echo 'ID: <b>' . $tempUserObject->getUid() . '</b> Username: <b>' . $tempUserObject->getUsername() . '</b> <i style="color:red;">inactive</i>';
                    }
                    echo '</button>';
                    ?>
                </h5>
            </div>

            <?php
            echo '<div id="editUserdata' . $tempUserObject->getUid() . '" class="collapse" data-parent="#userverwaltung_admin">';
            ?>
            <div class="card-body">
                <?php
                $tempUserPictureList = getPicsFromUser($tempUserObject->getUid());
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">BildId</th>
                            <th scope="col">Bildname</th>
                            <th scope="col">Freigabe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($tempUserPictureList as $pic) {
                            echo '<tr>';
                            echo '<th scope="row">' . $count . '</th>';
                            echo '<td>' . $pic->getBid() . '</td>';
                            echo '<td>' . $pic->getName() . '</td>';
                            if ($pic->getIsPublic()) {
                                echo '<td>public</td>';
                            } else {
                                echo '<td>private</td>';
                            }
                            echo '</tr>';
                            $count = $count + 1;
                        }
                        ?>

                    </tbody>
                </table>

                <hr>

                <form action="" method="POST">
                    <?php
                    echo '<input type="hidden" id="userId" name="userId" value="' . $tempUserObject->getUid() . '">';
                    ?>
                    <?php
                    echo '<input type="hidden" id="oldStatus" name="oldStatus" value="' . $tempUserObject->getIsActive() . '">';
                    ?>
                    <div class="form-group row">
                        <label for="activeStatus" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="activeStatus" name="activeStatus">
                                <option value="1">aktiv</option>
                                <?php
                                if (!$tempUserObject->getIsActive()) {
                                    echo '<option value="0" selected>inaktiv</option>';
                                } else
                                    echo '<option value="0">inaktiv</option>';
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8">
                            <button type="submit" name="changeStatus" class="btn btn-primary">Status aktualisieren</button>
                        </div>
                    </div>
                </form>

            </div>
            <?php
            echo '</div>';
            ?>
        </div>
        <?php
    }
    ?>
</div>