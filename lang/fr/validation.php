<?php

return [
    'required' => 'Le champ :attribute est obligatoire.',
    'string' => 'Le champ :attribute doit être un texte.',
    'email' => 'Le champ :attribute doit être une adresse e-mail valide.',
    'unique' => 'Cette valeur du champ :attribute est déjà utilisée.',
    'confirmed' => 'La confirmation du champ :attribute ne correspond pas.',
    'numeric' => 'Le champ :attribute doit être un nombre.',
    'exists' => 'La valeur choisie pour :attribute n\'existe pas.',
    'image' => 'Le fichier :attribute doit être une image.',
    'mimes' => 'Le fichier :attribute doit être de type : :values.',
    'uploaded' => 'Le fichier :attribute n\'a pas pu être envoyé.',
    'min' => [
        'string' => 'Le champ :attribute doit contenir au moins :min caractères.',
        'numeric' => 'Le champ :attribute doit être supérieur ou égal à :min.',
    ],
    'max' => [
        'string' => 'Le champ :attribute ne peut pas dépasser :max caractères.',
        'numeric' => 'Le champ :attribute ne peut pas dépasser :max.',
        'file' => 'Le fichier :attribute ne peut pas dépasser :max kilo-octets.',
    ],

    'attributes' => [
        'name' => 'nom',
        'email' => 'adresse e-mail',
        'password' => 'mot de passe',
        'titre' => 'titre',
        'isbn' => 'ISBN',
        'prix' => 'prix',
        'categorie_id' => 'catégorie',
        'couverture' => 'image de couverture',
        'dos' => 'image du dos',
    ],
];
