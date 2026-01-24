<?php

test('Главная страница доступна', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

