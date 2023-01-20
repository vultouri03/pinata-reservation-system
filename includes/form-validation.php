<?php

    $errors = [];
    if ($name == "") {
        $errors['name'] = 'er moet een naam worden ingevuld';
    }
    if ($email == "") {
        $errors['email'] = 'er moet een email adress worden ingevuld';
    }
    if ($phone == "") {
        $errors['phone'] = 'er moet een telefoonnummer worden ingevuld';
    }
    if (!is_numeric($phone)) {
        $errors['number'] = 'het telefoonummer moet een getal zijn';
    }
    if ($date == "") {
        $errors['date'] = 'er moet een datum worden ingevuld';
    }
    if ($address == "") {
        $errors['address'] = 'er moet een address worden ingevuld';
    }
    if ($pinata == "") {
        $errors['pinata'] = 'er moeten eisen die u aan de pinata verbind worden toegevoegd';
    }
    /*if (empty($tagIds)) {
        $errors['tag_ids'] = 'You need to choose at least 1 tag';
    }
*/
