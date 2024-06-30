<?php

namespace Tests\Feature\Admin\Auth;

use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    use RefreshDatabase;
 
     public function test_login_screen_can_be_rendered(): void
     {
         $response = $this->get('/admin/login');
 
         $response->assertStatus(200);
     }
 
     public function test_admins_can_authenticate_using_the_login_screen(): void
     {
         $admin = new Admin();
         $admin->email = 'admin@example.com';
         $admin->password = Hash::make('nagoyameshi');
         $admin->save();
 
         $response = $this->post('/admin/login', [
             'email' => $admin->email,
             'password' => 'nagoyameshi',
         ]);
        // 管理者としてログインしていることを検証
         $this->assertTrue(Auth::guard('admin')->check());
         $response->assertRedirect(RouteServiceProvider::ADMIN_HOME);
     }
 
     public function test_admins_can_not_authenticate_with_invalid_password(): void
     {
         $admin = new Admin();
         $admin->email = 'admin@example.com';
         $admin->password = Hash::make('nagoyameshi');
         $admin->save();
 
         $this->post('/admin/login', [
             'email' => $admin->email,
             'password' => 'wrong-password',
         ]);
        // Userが認証されていない
         $this->assertGuest();
     }
 
     public function test_admins_can_logout(): void
     {
         $admin = new Admin();
         $admin->email = 'admin@example.com';
         $admin->password = Hash::make('nagoyameshi');
         $admin->save();
        //  actingAs()メソッドの第二引数に'admin'を指定して、「管理者としてログアウトする」
         $response = $this->actingAs($admin, 'admin')->post('/admin/logout');
        
        //  Userが認証されていない
         $this->assertGuest();
         $response->assertRedirect('/');
     }

}