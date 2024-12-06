<?php
echo password_hash('admin123', PASSWORD_BCRYPT);
// SQL to use for using the generated hash for updating the row
// UPDATE users SET password = '<new_hash>' WHERE username = 'student';
?>
