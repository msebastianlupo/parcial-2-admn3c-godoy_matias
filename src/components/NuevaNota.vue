<template>
    <div class="contenedores-fijos">
        <form class="form-nota" @submit.prevent>
            <h1>Nueva nota</h1>
            <label for="titulo" :class="titulo.length > 3 ? 'label-ok' : 'label-error'">{{labelTi}}</label>
            <input type="text" name="titulo" id="titulo" placeholder="Nueva nota" v-model.trim="titulo" required @input="validar" @keypress.enter.prevent>
            <label for="texto" :class="texto.length > 19 ? 'label-ok' : 'label-error'">{{labelTe}}</label>
            <textarea name="text" id="texto" v-model="texto" @input="validar" required></textarea>
            <label for="color">Color</label>
            <input type="color" id="color" v-model="color">
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
                    identificacion: 0,
                    titulo: "",
                    texto: "",
                    color: "#000000",
                    fecha: "",
                    labelTi: "Colocale un título",
                    labelTe: "Describí la nota",
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
                    nota.co = this.color;
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
                if(this.titulo.length > 3 && this.texto.length > 19){
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
                this.color = this.edicion.co;
            }else{
                this.nueva = true;
                this.identificacion = Date.now();
            }
        }
    }
</script>