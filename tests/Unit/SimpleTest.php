<?php
test('сумма чисел 2+2', function () {
    $result = 2 + 2;
    expect($result)->toBe(4);
});
test('Прверка моего имени', function () {
    $name = "Admin";
    expect($name)->toBe('Admin');
});
