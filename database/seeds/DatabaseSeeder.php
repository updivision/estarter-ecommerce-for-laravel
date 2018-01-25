<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed users
        $this->call(UsersTableSeeder::class);

        // Seed countries list
        $this->call(CountriesTableSeeder::class);

        // Seed categories
        $this->call(CategoriesTableSeeder::class);

        // Seed attributes
        $this->call(AttributesTableSeeder::class);
        $this->call(AttributeSetsTableSeeder::class);
        $this->call(AttributeAttributeSetTableSeeder::class);
        $this->call(AttributeValuesTableSeeder::class);

        // Seed product with it's dependencies tables
        $this->call(TaxesTableSeeder::class);
        $this->call(ProductGroupsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(CategoryProductTableSeeder::class);
        $this->call(AttributeProductValueTableSeeder::class);

        // Seed permissions
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionRolesTableSeeder::class);
        $this->call(RoleUsersTableSeeder::class);

        // Seed currencies
        $this->call(CurrenciesTableSeeder::class);

        // Seed carriers
        $this->call(CarriersTableSeeder::class);

        // Seed order statuses
        $this->call(OrderStatusesTableSeeder::class);

        // Seed order statuses
        $this->call(NotificationTemplatesTableSeeder::class);

        // Seed client address
        $this->call(AddressesTableSeeder::class);

        // Seed client company
        $this->call(CompaniesTableSeeder::class);

        // Orders
        $this->call(OrdersTableSeeder::class);
    }
}
