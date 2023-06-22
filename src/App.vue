<template>
    <div id="app">
        <nav>
            <router-link to="/" tabindex="-1"><img class="menu-iconos" src="../src/assets/img/ideas.png" alt="Ideas" title="Ideas"></router-link>
            <router-link to='/notas' tabindex="-1"><img class="menu-iconos" src="../src/assets/img/icono.png" alt="Home" title="Home"></router-link>
            <router-link to='/acerca-de' tabindex="-1"><img class="menu-iconos" src="../src/assets/img/menu.png" alt="Acerca de Anotame" title="Acerca de Anotame"></router-link>
        </nav>
        <main>
            <transition name="component-fade" mode="out-in">
                <router-view/>
            </transition>
        </main>
    </div>
</template>
  
<style src="./assets/css-ft/estilos.css">
</style>