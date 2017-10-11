<script>
    export default {
        mounted() {
            this.classes;
        },
        updated() {
          $(this.$el).find('.selectpicker').selectpicker('refresh');
        },

        destroyed() {
          $(this.$el).find('.selectpicker').off().selectpicker('destroy');
        },  
        data () {
          return {
            classes: [],
            subjects: [],
          }
        },
        methods: {
          getId: function(e){
            let vm = this;
            axios.get('/api/teachers/subjects/'+ e.target.value)
            .then(function (response) {
              vm.classes = response.data.classes;
              vm.subjects = response.data.subjects;
            })
            .catch(function (error) {
              console.log(error);
            });
          }
        }
    }
</script>