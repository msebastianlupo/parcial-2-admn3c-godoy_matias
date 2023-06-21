<template>
    <div class="acerca-cont">
        <h1 class="h1-especial">{{h1}}</h1>
        <h2>{{h2}}</h2>
        <p v-if="sinBorrado">{{p}}</p>
        <p v-else>{{pBorrado}}</p>
        <button v-if="sinBorrado" class="btn-destruccion" @dblclick="borrarDatos">Borrar</button>
    </div>
</template>

<script>
    export default {
        name: 'AcercaDe',
        data:
            function() {
                return {
                    h1: "Anotame - © 2023 Matías Godoy",
                    h2: "Creá notas sin descargar nada - V. 23.05.24",
                    sinBorrado: true,
                    p: "Para borrar todos los datos de la app, presioná el botón 2 veces.",
                    pBorrado: "Listo, borraste todos los datos locales de la app.",
                }
            },
        methods: {
            borrarDatos(){
                localStorage.removeItem("anotame");
                this.sinBorrado = false;
                console.log("Datos borrados");
            }
        }
    }
</script>