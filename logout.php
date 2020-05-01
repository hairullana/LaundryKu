<?php

// hapus sesi
session_start();
session_destroy();


echo "
    <script>
        document.location.href = 'index.php';
    </script>
";


?>