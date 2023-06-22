<template>
    <div class="contenedores-fijos">
        <form class="form-nota" @submit.prevent>
            <h1>Nueva nota</h1>
            <label for="titulo" :class="titulo.length > 3 ? 'label-ok' : 'label-error'">{{labelTi}}</label>
            <input type="text" name="titulo" id="titulo" placeholder="Nueva nota" v-model.trim="titulo" required @input="validar" @keypress.enter.prevent>
            <label for="texto" :class="texto.length > 19 ? 'label-ok' : 'label-error'">{{labelTe}}</label>
            <textarea name="texto" id="texto" v-model="texto" @input="validar" required></textarea>
            <label for="prioridad" :class="prioridad ? 'label-ok' : 'label-error'">{{labelPr}}</label>
            <select name="prioridad" id="prioridad" v-model="prioridad" required @change="validar">
                <option value="" disabled>Seleccioná</option>
                <option v-for="(pr, index) in arrPrioridad" :key="index" :value="pr">{{pr}}</option>
            </select>
            <div class="btn-nueva-cont">
                <button @click="$emit('cancelado')">Cancelar</button>
                <button @click="guardar()">Guardar</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default{
        name: 'NuevaNota',
        data:
            function() {
                return {
                    nueva: true,
                    arrPrioridad: ["BAJA", "REGULAR", "IMPORTANTE", "URGENTE"],
                    identificacion: 0,
                    titulo: "",
                    texto: "",
                    prioridad: "",
                    fecha: "",
                    labelTi: "Colocale un título",
                    labelTe: "Describí la nota",
                    labelPr: "Elegí la prioridad",
                    arrNotasFix: this.arrNotas
                }
            },
        props: ["arrNotas", "edicion"],
        methods: {
            guardar(){
                if(this.validar()){
                    let nota = {};
                    nota.id = this.identificacion;
                    nota.ti = this.titulo.toUpperCase();
                    nota.te = this.texto;
                    nota.pr = this.prioridad;
                    nota.fe = this.fecha;
                    if(!this.nueva){
                        for(let nro in this.arrNotasFix){
                            if(this.arrNotasFix[nro].id === this.identificacion){
                                this.arrNotasFix.splice(nro, 1);
                            }
                        }
                    }
                    this.arrNotasFix.unshift(nota);
                    localStorage.setItem("anotame", JSON.stringify(this.arrNotasFix));
                    this.$emit("guardado");

                }
            },
            validar(){
                this.titulo.length > 3 ? this.labelTi = "El título está ok" : this.labelTi = `Faltan ${4 - this.titulo.length} caracteres`;
                this.texto.length > 19 ? this.labelTe = "La descripción está ok" : this.labelTe = `Al menos ${20 - this.texto.length} caracteres más`;
                this.prioridad ? this.labelPr = "La prioridad está ok" : this.labelPr = `Falta una prioridad`;
                if(this.titulo.length > 3 && this.texto.length > 19 && this.prioridad){
                    return true;
                }
                else {
                    return false;
                }
            }
        },

        mounted: function() {
            this.fecha = new Date().toLocaleDateString('en-CA');
            if(Object.keys(this.edicion).length){
                this.nueva = false;
                this.identificacion = this.edicion.id;
                this.titulo = this.edicion.ti;
                this.texto = this.edicion.te;
                this.prioridad = this.edicion.pr;
            }else{
                this.nueva = true;
                this.identificacion = Date.now();
            }
        }
    }
</script>

<style>
    .form-nota{
        display: flex;
        overflow-x: hidden;
        overflow-y: auto;
        width: 100%;
        max-width: 48rem;
        max-height: 70rem;
        margin: 3rem auto 0;
        padding: 2rem;
        flex-direction: column;
        background: #fff;
        color: #000;
        border-radius: 1rem;
    }

    .form-nota h1{
        font-size: 2.5rem;
    }

    #titulo, #texto{
        padding: 1.5rem;
        font-size: 2rem;
        box-shadow: inset 0 0 0.5rem #ccc;
    }

    textarea{
        min-height: 15rem;
        resize: none;
    }

    .btn-nueva-cont{
        display: flex;
        margin-top: 3rem;
    }

    .btn-nueva-cont button{
        width: 50%;
        padding: 1.5rem;
        font-size: 2rem;
        background: #000;
        color: #fff;
    }

    .btn-nueva-cont button:hover{
        background: #ff0066;
    }

    .btn-nueva-cont button:first-of-type{
        border-radius: 1rem 0 0 1rem;
    }

    .btn-nueva-cont button:last-of-type{
        border-radius: 0 1rem 1rem 0rem;
    }
</style>