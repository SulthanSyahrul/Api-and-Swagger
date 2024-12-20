<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDashboardIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Membuat akun admin untuk digunakan di seluruh pengujian
        $this->admin = Admin::create([
            'name' => 'Test Admin',
            'email' => 'testadmin@example.com',
            'password' => bcrypt('password'),
        ]);
    }

    public function test_admin_can_login_and_access_dashboard()
    {
        // Login menggunakan akun admin
        $response = $this->post('/login', [
            'email' => $this->admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
        $this->actingAs($this->admin)->get('/dashboard')->assertStatus(200);
    }

    public function test_admin_can_manage_products()
    {
        $this->actingAs($this->admin);

        // Tambah produk
        $response = $this->post('/produk', [
            'name' => 'Test Product',
            'category' => 'Test Category',
            'image' => UploadedFile::fake()->image('test-image.jpg'),
            'stock' => 10,
            'price' => 50000,
            'description' => 'Test Description',
        ]);

        $response->assertRedirect('/produk');
        $this->assertDatabaseHas('produk', ['name' => 'Test Product']);

        // View produk
        $product = Produk::first();
        $response = $this->get("/produk/{$product->id_produk}");
        $response->assertStatus(200);
        $response->assertSee('Test Product');
        $response->assertSee('Test Description');

        // Edit produk
        $response = $this->put("/produk/{$product->id_produk}", [
            'name' => 'Updated Product',
            'category' => 'Updated Category',
            'stock' => 20,
            'price' => 75000,
            'description' => 'Updated Description',
        ]);

        $response->assertRedirect('/produk');
        $this->assertDatabaseHas('produk', ['name' => 'Updated Product']);

        // Hapus produk
        $response = $this->delete("/produk/{$product->id_produk}");
        $response->assertRedirect('/produk');
        $this->assertDatabaseMissing('produk', ['name' => 'Updated Product']);
    }

    public function test_admin_can_manage_categories()
    {
        $this->actingAs($this->admin);

        // Tambah kategori
        $response = $this->post('/kategori', [
            'name' => 'Test Category',
        ]);
        $response->assertRedirect('/kategori');
        $this->assertDatabaseHas('kategori', ['name' => 'Test Category']);

        $category = Kategori::first();

        // Edit kategori
        $response = $this->put("/kategori/{$category->id_kategori}", [
            'name' => 'Updated Category',
        ]);
        $response->assertRedirect('/kategori');
        $this->assertDatabaseHas('kategori', ['name' => 'Updated Category']);

        // Hapus kategori menggunakan show method (GET request)
        $response = $this->get("/kategori/{$category->id_kategori}");
        $response->assertRedirect('/kategori');
        $this->assertDatabaseMissing('kategori', ['name' => 'Updated Category']);
    }
}
