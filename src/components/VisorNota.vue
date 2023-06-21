<template>
    <div class="contenedores-fijos" ref="visor" @keydown.esc="$emit('cerrado')" tabindex="-1">
        <div class="visor-cont" :style="aplicarShadow(nota.co)">
            <div class="acciones-visor">
                <img src="img/cerrar.png" alt="Cerrar" @click="$emit('cerrado')">
                <img src="img/editar.png" alt="Editar" @click="$emit('edicion')">
                <img src="img/borrar.png" alt="Borrar" @click="alternarModal">
            </div>
            <h2>{{nota.ti}}</h2>
            <h3>{{nota.fe}}</h3>
            <p>{{nota.te}}</p>
        </div>
        <div class="contenedores-fijos" v-if="modal">
            <div class="modal-cuadro">
                <p>Una vez borradas, las notas no se pueden recuperar. Confirmá.</p>
                <div class="btn-modal-cont">
                    <button @click="alternarModal">Volver</button>
                    <button @click="$emit('borrado')">Borrar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        name: 'VisorNota',
        data:
            function() {
                return {
                    modal: false
                }
            },
        props: ["nota"],
        methods: {
            alternarModal(){
                this.modal ? this.modal = false : this.modal = true;
            },
            aplicarShadow(color){
                return `box-shadow: 0 0 0.5rem ${color}`;
            }
        },
        mounted() {
            this.$refs.visor.focus();
        }
    }
</script>