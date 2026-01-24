<?php
use App\Models\User;

test('у пользователя правильно устанавливается имя', function () {
    $user = new User();
    $user->name = 'Алексей';
    expect($user->name)->toBe('Алексей');
});
