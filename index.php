<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Blog</title>
</head>
<body>
    <h1>Blog</h1>

    <div id="app">
        {{persons}}
        <button @click="addPerson">Ajouter un truc</button>
<!--        <input type="checkbox" v-model="cls" :true-value="'success" :false-value="'error">-->
<!--        <a v-bind:href="link">{{message}}</a>-->
<!--        <a :href="link">{{message}}</a>-->
<!---->
<!--        <ul>-->
<!--            <li v-for="person in persons">{{person}}</li>-->
<!--        </ul>-->
        <div v-if="success">
<!--            <i class="close icon" :class="success: success, error: !success" @click="close">aa</i>-->
            <p>{{message}}</p>
        </div>
<!--        <div v-else>-->
<!--            <p>Loose</p>-->
<!--        </div>-->
    </div>
    <a href="views/inscription.php" id="inscription">Inscription</a>
    <a href="views/login.php" id="login">Login</a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.0-rc.5/vue.js"></script>
    <script src="public/js/script.js"></script>
</body>
</html>