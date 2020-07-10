<?php

/* config files first */
include 'config/fileLocations.php';
include 'config/dbaccess.php';

/* utils then */
include 'util/dbBildFunctions.php';
include 'util/helper.php';
include 'util/dbHelperFunctions.php';
include 'util/dbUserFunctions.php';


/* models last */
include 'model/Tag.php';
include 'model/Bild.php';
include 'model/User.php';
