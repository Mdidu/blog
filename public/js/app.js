let vm = new Vue({
    el: '#app',
    data: {
        seconds: 0
    },
    mounted: function () {
        this.$interval = setInterval( () => {
            this.seconds++
        }, 1000)
    },
    destoyed: function () {
        clearInterval(this.$interval);
    }
})

/*
let vm = new Vue({
    el: '#app',
    data: {
        message: 'Salut',
        link: 'http://grafikart.fr',
        cls: 'success',
        persons: ['john', "goku", "vegeta"]
    },
    methods: {
        close: function () {
            this.message = "fermé";
            this.success = false;
        },
        addPerson: function () {
            this.persons.push("Mario")
        },
        beforeCreate: function () {
            console.log(this.el);
        }
    },
    style: function () {
        if(this.success){
            return 'background: #32FF08';
        }else {
            return 'background: #4700FF';
        }
    }
});
 */