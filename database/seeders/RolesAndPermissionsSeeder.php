<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// php artisan db:seed --class=RolesAndPermissionsSeeder


class RolesAndPermissionsSeeder extends Seeder

{
    public function run()
    {
        // Effacer les permissions et rôles existants pour éviter les duplications
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Créer les permissions pour chaque fonctionnalité
        Permission::create(['name' => 'manage users']); // Pour l'admin
        Permission::create(['name' => 'manage categoriesBack']); // Pour la gestion des catégories
        Permission::create(['name' => 'manage categoriesFront']); // Pour la gestion des catégories
        Permission::create(['name' => 'manage reservations']); // Pour la gestion des réservations
        Permission::create(['name' => 'manage commandes']); // Pour la gestion des réservations
        Permission::create(['name' => 'manage payments']); // Pour la gestion des paiements
        Permission::create(['name' => 'edit profile']); // Pour que les utilisateurs modifient leur profil
        Permission::create(['name' => 'manage blogFront']); // Pour que les utilisateurs modifient leur profil
        Permission::create(['name' => 'manage blogBack']); // Pour que les utilisateurs modifient leur profil
        Permission::create(['name' => 'manage eventBack']); // Pour que les utilisateurs modifient leur profil
        Permission::create(['name' => 'manage eventFront']); // Pour que les utilisateurs modifient leur profil




        // Créer les rôles et leur attribuer des permissions
        $adminRole = Role::create(['name' => 'admin']);
        $clientRole = Role::create(['name' => 'client']);

        // Assigner des permissions au rôle admin
        $adminRole->givePermissionTo('manage users');
        $adminRole->givePermissionTo('manage categoriesBack');
        $adminRole->givePermissionTo('manage commandes');
        $adminRole->givePermissionTo('manage blogBack');
        $adminRole->givePermissionTo('manage eventBack'); 
        $adminRole->givePermissionTo('edit profile'); 

        // Assigner des permissions au rôle client
        $clientRole->givePermissionTo('edit profile'); // Le client peut seulement éditer son profil
        $clientRole->givePermissionTo('manage categoriesFront');
        $clientRole->givePermissionTo('manage reservations');
        $clientRole->givePermissionTo('manage payments');
        $clientRole->givePermissionTo('manage blogFront');
        $clientRole->givePermissionTo('manage eventFront');

    }
}
