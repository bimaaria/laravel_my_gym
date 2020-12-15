<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'gallery' => [
        'title' => 'Galleries',

        'actions' => [
            'index' => 'Galleries',
            'create' => 'New Gallery',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'desc' => 'Desc',
            'image' => 'Image',
            
        ],
    ],

    'trainer' => [
        'title' => 'Trainers',

        'actions' => [
            'index' => 'Trainers',
            'create' => 'New Trainer',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            
        ],
    ],

    'about' => [
        'title' => 'Abouts',

        'actions' => [
            'index' => 'Abouts',
            'create' => 'New About',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'body' => 'Body',
            'image' => 'Image',
            
        ],
    ],

    'banner' => [
        'title' => 'Banners',

        'actions' => [
            'index' => 'Banners',
            'create' => 'New Banner',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
            'image' => 'Image',
            
        ],
    ],

    'message' => [
        'title' => 'Messages',

        'actions' => [
            'index' => 'Messages',
            'create' => 'New Message',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'message' => 'Message',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];