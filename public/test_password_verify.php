<?php
$plainPassword = '123';
$hashedPassword = '$2y$10$zWBlhdPprhEiWadf.Mwl1uXvHTRCJt4Dy.kCN/xibIGVJscT8p5Dq'; // Precomputed hash for "123"

if (password_verify($plainPassword, $hashedPassword)) {
    echo "Password verification PASSED.";
} else {
    echo "Password verification FAILED.";
}
?>

<?php
echo password_hash('123', PASSWORD_BCRYPT);
?>
