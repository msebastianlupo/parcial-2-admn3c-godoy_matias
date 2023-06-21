<template>
    <div class="notas-cont">
        <div class="busqueda-cont"><input id="busqueda" type="search" placeholder="Buscá notas guardadas" v-model.trim="buscador" @input="levantarTexto"><img class="btn-nueva-nota" src="../assets/img/nueva.png" alt="Botón nueva nota" @click="editar" title="Crear una nota"></div>
        <h1 id="h1-main" v-if="buscador">{{buscador | contarCoincidencias}}</h1>
        <h1 id="h1-main" v-else-if="local">{{arrNotas | pluralizarH1}}</h1>
        <h1 id="h1-main" class="h1-pred" v-else @click="editar">{{h1Pred}}</h1>
        <div class="notas-items-cont">
            <div class="notas-items" v-for="(nota, index) in arrNotas" :key="index" @click="capturar(nota)" :style="estilos[index]" v-show="buscador === '' || nota.ti.includes(buscador)">
                <h2 class="h2-items">{{nota.ti}}</h2><span class="fecha">{{nota.fe}}</span>
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
                    estilos: []
                }
            }
        ,
        filters: {
        pluralizarH1: function(notas){
            if (Array.isArray(notas)){
                if(notas.length){
                    return notas.length > 1 ? `${notas.length} notas guardadas` : `1 nota guardada`;
                }
            }
            return '';
        },
        contarCoincidencias: function(notas, buscador){     
            let contador = 0;      
            if(Array.isArray(notas) && notas.length){
                for(let n of notas){
                    if(n.ti.includes(buscador)){
                        contador++;
                    }
                }
            }
            return contador ? `Notas encontradas: ${contador}` : "Búsqueda sin resultados";
        }
    },
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
                    this.estilos = [];
                    this.local = true;
                    for(let nota of this.arrNotas){
                        let boxShadow = `0 0 0.3rem 0.1rem ${nota.co}`;
                        this.estilos.push({'border-color': nota.co, 'box-shadow': boxShadow});
                    }
                }
            }
        },
        mounted: function() {
            this.actualizar();
        }
    }
</script>