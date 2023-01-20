<?php
    $errors = [];

    if ($email == "") {
        $errors['email'] = 'er moet een email adress worden ingevuld';
    }
    if ($phone == "") {
        $errors['phone'] = 'er moet een telefoonnummer worden ingevuld';
    }

    if ($id == "") {
        $errors['id'] = 'u moet de user id toevoegen';
    }

