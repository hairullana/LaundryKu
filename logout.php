<?php

session_start();

session_destroy();

echo "
    <script>
        alert('Berhasil logout !');
        document.location.href = 'index.php';
    </script>
";

?>