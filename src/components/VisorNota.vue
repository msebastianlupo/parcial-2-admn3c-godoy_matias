<template>
    <div class="contenedores-fijos" ref="visor" @keydown.esc="$emit('cerrado')" tabindex="-1">
        <div class="visor-cont">
            <div class="acciones-visor">
                <img src="../assets/img/cerrar.png" alt="Cerrar" @click="$emit('cerrado')">
                <img src="../assets/img/editar.png" alt="Editar" @click="$emit('edicion')">
                <img src="../assets/img/borrar.png" alt="Borrar" @click="alternarModal">
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
            }
        },
        mounted() {
            this.$refs.visor.focus();
        }
    }
</script>

<style>
    .visor-cont{
        overflow-x: hidden;
        overflow-y: auto;
        width: 100%;
        height: calc(100% - 10rem);
        max-width: 48rem;
        padding: 2rem 2rem 20rem;
        margin: 3rem auto 0;
        border-radius: 1rem;
        background: #000;
        color: #fff;
        white-space: pre-wrap;
        box-shadow: 0 0 0.5rem #ff0066;
    }

    .acciones-visor{
        position: sticky;
        top: 0;
        display: flex;
        justify-content: end;
    }

    .acciones-visor img{
        width: 3rem;
        margin-left: 1.5rem;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 0 1rem #ccc;
    }

    .acciones-visor img:hover{
        box-shadow: 0 0 1rem #ff0066;
    }

    .visor-cont h2{
        margin-top: 3rem;
        font-size: 2rem;
    }

    .visor-cont h3{
        font-size: 1.2rem;
        color: #ff0066;
    }

    .visor-cont p{
        margin-top: 4rem;
        font-size: 1.6rem;
    }
</style>