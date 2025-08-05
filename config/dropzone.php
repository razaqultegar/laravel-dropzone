<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Permanent File Storage Disk
    |--------------------------------------------------------------------------
    |
    | This disk is used to store the final uploaded files after moving them
    | from temporary location. It should be defined in config/filesystems.php.
    |
    */
    'disk' => 'public',

    /*
    |--------------------------------------------------------------------------
    | Temporary File Storage Disk
    |--------------------------------------------------------------------------
    |
    | This disk is used to store the file chunks or temporary uploaded files
    | before moving them to the permanent location.
    |
    */
    'temp_disk' => 'local',

    /*
    |--------------------------------------------------------------------------
    | Temporary Folder Name
    |--------------------------------------------------------------------------
    |
    | Files will be saved under this folder on the temporary disk.
    |
    */
    'temp_folder' => 'temp',

    /*
    |--------------------------------------------------------------------------
    | Dropzone Route Middleware
    |--------------------------------------------------------------------------
    |
    | You may define a list of middleware that will be applied to
    | Dropzone routes.
    |
    */
    'middleware' => ['web', 'auth'],

    /*
    |--------------------------------------------------------------------------
    | Check Permission by user_id
    |--------------------------------------------------------------------------
    |
    | Files are only accessible by the user who uploaded them based on
    | `user_id` field in database. Set to false to disable.
    |
    */
    'check_permission' => true,

];
