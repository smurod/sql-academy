<?php

test('проверка 2+2 равно 4', function () {
   $a = 1;
   $b =2;
   $result = $a+$b;
   expect($result)->toBe(3);
});
