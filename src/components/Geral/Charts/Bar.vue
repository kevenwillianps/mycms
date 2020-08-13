<script>

    import { Bar } from "vue-chartjs";

    export default {

        extends: Bar,

        props : {

            labels : {

                type : Array

            },
            label : {

                type : String

            },
            backgroundColor : {

                type : String

            },
            data : {

                type : Array

            },

        },

        mounted () {

            this.renderChart({

                labels: this.labels,

                datasets: [

                    {

                        label: this.label,
                        backgroundColor: this.backgroundColor,
                        data: this.data,

                    }

                ],

            }, {responsive: true, maintainAspectRatio: true});

        }

    }
</script>