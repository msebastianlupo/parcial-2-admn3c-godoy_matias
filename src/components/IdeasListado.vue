<template>
    <div class="ideas-cont">
        <h1 class="h1-especial">{{h1}}</h1>
        <button class="btn-obtener" @click="obtenerIdeas">Obtener ideas</button>
        <div class="ideas-listado-cont">
            <p class="p-item" v-for="(idea, index) in lista" :key="index">{{idea}}</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'IdeasListado',
        data:
            function() {
                return {
                    h1: "Ideas para no aburrirte",
                    lista: []
                }
        },
        methods: {
            obtenerIdeas(){
                if(navigator.onLine){
                    this.crearCarga();
                    fetch(`https://mstest.webcindario.com/app-dis-mov/ideas.php`)
                    .then(res => {
                        return res.json();
                    })
                    .then(json => {
                        this.lista = json.ideas;
                        this.romperCarga();
                    })
                    .catch(() => {
                        console.warn("No se puede obtener el archivo");
                        this.h1 = "No se puede obtener ideas";
                        this.romperCarga();
                    })
                }
            },
            crearCarga(){
                console.info("Se están realizando tareas, aguardá");
                let div = document.createElement("div");
                div.classList.add("div-bloqueado");
                document.body.append(div);
                div.tabIndex = -1;
                div.focus();
                setTimeout(() => {
                    if(document.querySelector(".div-bloqueado")){
                      //  this.romperCarga();
                    }
                }, 15000);
            },
            romperCarga(){
                let bloqueado = document.querySelector(".div-bloqueado")
                if(bloqueado)
                bloqueado.remove();
            }
        }
    }
</script>

<style>
    .ideas-cont{
        display: flex;
        flex-direction: column;
        max-width: 768px;
        margin: 5rem auto;
        align-items: center;
        text-align: center;
    }

    .div-bloqueado{
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5) url('../assets/img/loading.gif') no-repeat center 25%;
        background-size: 5rem;
    }
    .ideas-listado-cont{
        margin-top: 5rem;
        display: flex;
        flex-wrap: wrap;
    }

    .p-item{
        width: 100%;
        margin: 0.4rem;
        padding: 2rem 0.5rem;
        background: #000;
        border: 0.1px solid #222;
        border-radius: 0.5rem;
        font-size: 2rem;
    }

    .btn-obtener{
        font-size: 2rem;
        margin-top: 3rem;
        background: #ff0066;
        color: #fff;
    }

    @media screen and (min-width: 769px){
        .p-item{
            width: calc(33.333% - 2.4rem);
        }
    }
</style>