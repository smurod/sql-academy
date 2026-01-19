<?php

use function Pest\Laravel\get;

test('Главная страница доступна', function () {
    get('/')->assertStatus(200);
});

test('Страница Login рботает и там есть текст Google', function () {
    //Arrange
    //Act
    $response = $this->get('/login');
    //Assert
    $response->assertStatus(200);
    $response->assertSee('Google');
});

test('страница входа загружвается корректно', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
    $response->assertSee('name="email"', escape: false);
});

test('Пользователь не может войти с неверным паролем', function () {
    $user = \App\Models\User::factory()->create([
        'password' => bcrypt('correct-password')
    ]);
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password'
    ]);
    $response->assertSessionHasErrors(['email']);
    $this->assertGuest();
});

test('авторизованный пользователь видит свою почту на дашборде', function () {
    // 1. Создаем пользователя
    $user = \App\Models\User::factory()->create([
        'email_verified_at' => now(), // Помечаем, что почта подтверждена
    ]);

    // 2. Логинимся и идем на дашборд
    $response = $this->actingAs($user)->get('/dashboard');

    // 3. Проверяем
    $response->assertStatus(200);

    // Ищем именно ту почту, которую создал factory
    $response->assertSee($user->email);
});

test('Пользоватеб не может зайди на админку без авторизации', function () {
    $response = $this->get('/dashboard');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
});

test('Авторизованный пользователь может выйти из системы', function () {
    $user = \App\Models\User::factory()->create([
        'email_verified_at' => now(),
    ]);
    $response = $this->actingAs($user)->get('/dashboard');
    $response = $this->post('/logout');
    $response->assertRedirect('/');
    $this->assertGuest();
});

test('Не зарегистрированный пользователь может просмотреть список курсов админки', function () {
    $response = $this->get('/admin/courses');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
    $this->assertGuest();
});

test('Не авторизованный пользователь может смотреть курсы от админки', function () {
    $user = \App\Models\User::factory()->create([
        'email_verified_at' => now(),
    ]);
    $response = $this->actingAs($user)->get('/admin/courses');
    $response->assertStatus(200);
});

