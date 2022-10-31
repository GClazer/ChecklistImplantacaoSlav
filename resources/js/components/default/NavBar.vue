<template>
    <div>
        <nav id="nav-bar">
            <ul>
                <a href="/adm/checklists"><li>Adicionar checklist</li></a>
                <a href="/adm/tasks"><li>Adicionar tarefa</li></a>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {

    }
</script>

<style>
#nav-bar {
    width: 100%;
    padding: 20px 0px;
    margin: 0 auto;
    border: 1px blue solid;
    display: block;
}

#nav-bar ul {
    list-style: none;
    width: 80%;
    margin: 0 auto;
    justify-content: space-around;
    display: flex;
}
</style>