# Telescope

1. composer require laravel/telescope
2. php artisan telescope:install
3. php artisan migrate
4. php artisan optimize

# Laravel-Passport

1.  composer create-project laravel/laravel rodecycle 8.\*
2.  composer require laravel/passport
3.  php artisan migrate
4.  php artisan passport:install
5.  php artisan passport:keys
6.  php artisan passport:client --personal (or create from seeder database)

# Spatie permitions

1.  composer require spatie/laravel-permission
2.  'providers' => [
    // ...
    Spatie\Permission\PermissionServiceProvider::class,
    ];
3.  php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

# Tenant

$tenant1 = App\Models\Tenant::create(['id' => 'merida']);
$tenant1->domains()->create(['domain' => 'merida.rodecycle.local']);

$tenant2 = App\Models\Tenant::create(['id' => 'villa']);
$tenant2->domains()->create(['domain' => 'villa.rodecycle.local']);

php artisan tenants:list

php artisan tenants:seed --tenants=villa --class=RoleSeeder
php artisan tenants:seed --tenants=villa --class=PermissionSeeder

php artisan tenant:seed class=NAMESEED
php artisan tenants:migrate
php artisan tenants:rollback

php artisan make:migration add_active_to_waitlists_table
artisan migrate:refresh --path=/database/migrations/my_migrations.php

php artisan tenants:migrate-fresh --path=/database/migrations/tenant/2022_07_17_205458_add_active_to_waitlists_table.php

# Permitions customer-role

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
VALUES
(33, 3),
(38, 3),
(39, 3),
(41, 3);

php artisan make:migration create_layouts_table

# JObs

php artisan queue:table
just its working in the central with mysql
php artisan queue:work

php artisan queue:failed  
php artisan queue:retry 53006d44-b66e-4c58-9690-6c4c6f69750d

# Mailgun

config/mail.php
config/services.php

Personal access client created successfully.
Client ID: 9739ab1e-455f-4d31-a0e0-bf787d66f6ea
Client secret: dPww6WjGNbVqX61qp1BlYhjZlGnMy3taln1XWPjZ
Password grant client created successfully.
Client ID: 9739ab1e-5879-43ee-a0b3-bd978cac0f40
Client secret: MTOOoUtBb8245ZHO74LClbdKsn1udUKnGtnpxneU


## Create modules
php artisan make:migration create_branches_table
php artisan make:controller Api/BranchController
php artisan make:model Branch
php artisan make:resource BranchResource
php artisan make:request BranchRquest
