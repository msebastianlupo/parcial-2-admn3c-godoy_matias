<template>
    <div class="notas-cont">
        <div class="busqueda-cont"><input id="busqueda" type="search" placeholder="Podés buscar por título o prioridad" v-model.trim="buscador" @input="levantarTexto"><img class="btn-nueva-nota" src="../assets/img/nueva.png" alt="Botón nueva nota" @click="editar" title="Crear una nota"></div>
        <h1 id="h1-main" v-if="buscador">Filtro activado</h1>
        <h1 id="h1-main" v-else-if="local">Todas las notas</h1>
        <h1 id="h1-main" class="h1-pred" v-else @click="editar">{{h1Pred}}</h1>
        <div class="notas-items-cont">
            <div class="notas-items" v-for="(nota, index) in arrNotas" :key="index" @click="capturar(nota)" v-show="buscador === '' || nota.ti.includes(buscador) || nota.pr === buscador">
                <h2 class="h2-items">{{nota.ti}}</h2>
                <div class="span-cont">
                    <span :class="'prioridad ' + prClases[nota.pr]">{{nota.pr}}</span>
                    <span class="fecha">{{nota.fe}}</span>
                </div>
            </div>
            <VisorNota :nota="dataClick" @cerrado="cerrar" @edicion="editar" @borrado="borrar" v-if="visor"></VisorNota>
            <NuevaNota v-if="nueva" :arrNotas="arrNotas" :edicion="dataClick" @cancelado="cancelar" @guardado="resetear"></NuevaNota>
        </div>
    </div>
</template>
<script>
    import VisorNota from './VisorNota.vue'
    import NuevaNota from './NuevaNota.vue'

    export default {
        name: 'AnotameNotas',
        components: {
            VisorNota,
            NuevaNota
        },   
        data:
            function(){
                return{
                    local: false,
                    h1: "",
                    h1Pred: "Sin notas. Agregá una.",
                    arrNotas: [],
                    dataClick: {},
                    visor: false,
                    nueva: false,
                    buscador: "",
                    prClases: {"URGENTE": "pr-urgente", "IMPORTANTE": "pr-importante", "REGULAR": "pr-regular", "BAJA": "pr-baja"}

                }
            }
        ,
        methods: {
            capturar(nota){
                this.dataClick = nota;
                this.visor = true;
            },
            cancelar(){
                this.nueva = false;
                if(Object.keys(this.dataClick).length){
                    this.visor = true;
                }
            },
            cerrar(){
                this.dataClick = {};
                this.visor = false;
            },
            editar(){
                this.visor = false;
                this.nueva = true;
            },
            borrar(){
                for(let nro in this.arrNotas){
                    if(this.arrNotas[nro].id === this.dataClick.id){
                        this.arrNotas.splice(nro, 1);
                    }
                }
                if(this.arrNotas.length){
                    localStorage.setItem("anotame", JSON.stringify(this.arrNotas));
                }else{
                    localStorage.removeItem("anotame");
                    this.local = false;
                }
                this.resetear();
            },
            resetear(){
                this.nueva = false;
                this.cerrar();
                this.actualizar();
            },

            levantarTexto(){
                this.buscador = this.buscador.toUpperCase();
            },
            actualizar(){
                let almacenadas = localStorage.getItem("anotame");
                if(almacenadas){
                    this.arrNotas = JSON.parse(almacenadas);
                    this.local = true;
                }
            }
        },
        mounted: function() {
            this.actualizar();
        }
    }
</script>

<style>
    .busqueda-cont{
        display: flex;
        max-width: 768px;
        margin-top: 5rem;
        justify-content: space-between;
        align-items: center;
    }

    #busqueda{
        width: calc(100% - 7rem);
        height: 5rem;
        padding: 2rem;
        font-size: 1.5rem;
        box-shadow: inset 0 0 1rem #333;
        border: 0.1rem solid #ddd;
    }

    .btn-nueva-nota{
        padding: 1rem;
        width: 4.5rem;
        background: #fff;
        border-radius: 50%;
    }

    .btn-nueva-nota:hover{
        box-shadow: 0 0 1rem #ff0066;
    }

    .h1-pred:hover{
        cursor: pointer;
        color: #ff0066;
    }

    .notas-cont{
        display: flex;
        flex-direction: column;
        max-width: 768px;
        margin: 0 auto;
    }

    .notas-items{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 1.5rem 0;
        padding: 3rem 1rem;
        background: #242424;
        border-radius: 0.6rem;
    }

    .notas-items:hover{
        cursor: pointer;
        color: #ddd;
    }

    .h2-items{
            width: 50%;
            text-overflow: ellipsis;
            overflow-x: hidden;
            white-space: nowrap;
            font-weight: normal;
            text-shadow: 0.1rem 0.1rem #111;
        }

    .span-cont{
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .prioridad{
        font-size: 1.6rem;
    }

    .fecha{
        font-size: 1.3rem;
    }

    /*tablet*/
    @media screen and (min-width: 481px){
        #busqueda{
            font-size: 1.5rem;
        }

        .h2-items{
            font-size: 2rem;
        }
    }

    /*pc*/
    @media screen and (min-width: 769px){
        .notas-items-cont{
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .notas-items{
            display: flex;
            flex-direction: column;
            width: calc(50% - 1rem);
            margin: 1rem 0;
        }

        .h2-items{
            width: 100%;
            margin-bottom: 1rem;
            font-size: 2.2rem;
            text-align: center;
        }

        .fecha{
            font-size: 1.5rem;
        }
    }
</style>