# Laravel Dropzone

A clean and modular backend implementation of [Dropzone](https://dropzone.dev) file upload system for Laravel applications. This package is designed to help Laravel developers easily integrate Dropzone's file upload capabilities — including chunk uploads — into their applications without reinventing the wheel.

Out of the box, it provides:

- Seamless single and multiple file uploads.
- Chunk uploads with large file support.
- Resume support via Dropzone’s built-in chunking mechanism.
- Stores uploaded files in a secure temporary storage.
- Easy retrieval and transition from temporary to permanent storage.
- Customizable encryption-based file tracking.
- Clear separation of concerns via service architecture.
- Developer-friendly API and controller-level integration.
- Uses Laravel's native Storage API to support third-party cloud disks.
- Flexible to extend or override based on your business logic.
- Simple configuration and zero-boilerplate setup.

## Installation

Require the package using Composer:

```bash
composer require razaqultegar/laravel-dropzone
```

Publish the configuration and migration files using the Artisan vendor:publish command:

```bash
php artisan vendor:publish --tag=dropzone
```

_*This will create `config/dropzone.php` and `database/migrations/xxxx_xx_xx_xxxxxx_create_dropzones_table.php`_

After publishing, run the migration to create the dropzones table:

```bash
php artisan migrate
```

## Quickstart (Coming Soon)

More usage instructions will be added soon for:

- Upload controller
- Chunk handler
- Retrieving file metadata
- Moving to permanent storage

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.