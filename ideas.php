<?php
header("Access-Control-Allow-Origin:*");

$arrIdeas = [
    "ideas" =>
        [
            "Leer un libro",
            "Ir al cine",
            "Hacer ejercicio",
            "Cocinar algo nuevo",
            "Hacer senderismo",
            "Visitar un museo",
            "Hacer un picnic",
            "Escuchar música",
            "Hacer un viaje",
            "Ir a un concierto",
            "Practicar yoga",
            "Juegos de mesa",
            "Aprender un idioma",
            "Ir a nadar",
            "Ir a galería de arte",
            "Hacer voluntariado",
            "Ver una obra teatral",
            "Excursión en bicicleta",
            "Fotos a la naturaleza",
            "Parque de diversiones",
            "Visitar un acuario",
            "Una sesión de spa",
            "Visitar a un amigo",
            "Descargarse juegos",
            "Ir a comprar al súper",
            "Practicar meditación",
            "Hacer manualidades",
            "Ir a la playa",
            "Ver el ocaso",
            "Maratón de pelis",
            "Algo de jardinería",
            "Aprender a programar",
            "Visitar un ecoparque",
            "Ir a una feria local",
            "Hacer una fiesta",
            "Practicar dibujo",
            "Hacer una caminata",
            "Andar en patineta",
            "Ir a lugar histórico",
            "Bailar algo nuevo",
            "Pedir una buena pizza",
            "Parque de aventuras",
            "Ir a mercado de pulgas",
            "Dormir una siesta",
            "Fotografía de retrato",
            "Buscar cosas perdidas",
            "Hacer un nuevo curso",
            "Jugar al mini golf",
            "Una noche de fogata",
            "Ver videos divertidos",
            "Atender a tu mascota"  
        ]
]; 
echo json_encode($arrIdeas);

?>