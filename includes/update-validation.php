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
    if ($date == "") {
        $errors['date'] = 'er moet een datum worden ingevuld';
    }
    if ($address == "") {
        $errors['address'] = 'er moet een address worden ingevuld';
    }
    if ($pinata == "") {
        $errors['pinata'] = 'er moeten eisen die u aan de pinata verbind worden toegevoegd';
    }


