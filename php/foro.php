<?php
        require 'conectUser.php';

        $sql = "SELECT nombre, tema, contenido FROM foro"; 
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            echo "<ul>";
            while($row = $result->fetch_assoc()) {
                echo "<li><strong>" . htmlspecialchars($row["titulo"]) . "</strong>: " . htmlspecialchars($row["contenido"]) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "No hay foros disponibles.";
        }

        $conn->close();
    
    ?>