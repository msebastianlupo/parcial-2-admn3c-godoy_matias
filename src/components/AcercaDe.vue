<template>
    <div class="acerca-cont">
        <h1 class="h1-especial">{{h1}}</h1>
        <h2>{{h2}}</h2>
        <p v-if="sinBorrado">{{p}}</p>
        <p v-else>{{pBorrado}}</p>
        <button v-if="sinBorrado" class="btn-cta" @dblclick="borrarDatos">Borrar</button>
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

<style>
    .acerca-cont{
        display: flex;
        flex-direction: column;
        max-width: 768px;
        margin: 5rem auto;
        align-items: center;
        text-align: center;
    }

    .h1-especial{
        font-size: 3rem;
    }

    .acerca-cont h2{
        margin-top: 0.5rem;
        font-size: 2rem;
    }

    .acerca-cont p{
        margin-top: 5rem;
        font-size: 1.8rem;
    }
</style>