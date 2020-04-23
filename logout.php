<?php

session_start();

session_destroy();

echo "
    <script>
        alert('BERHASIL LOGOUT');
        document.location.href = 'index.php';
    </script>
";

?>