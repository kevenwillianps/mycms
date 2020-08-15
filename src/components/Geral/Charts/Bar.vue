<script type="text/ecmascript-6">

    import { Bar } from "vue-chartjs";

    export default {

        extends : Bar,

        props : {

            labelP : {

                type: String,

            },

            labelsP : {

                type: Array

            },

            backgroundColorP : {

                type: String,

            },

            dataP: {

                type: Array

            }

        },

        data(){

            return {

                chartdata: {

                    labels: this.labelsP,

                    datasets: [

                        {
                            label: this.labelP,
                            backgroundColor: this.backgroundColorP,
                            data : this.dataP
                        }

                    ]

                },

                options: {

                    responsive: true,
                    maintainAspectRatio: false

                }

            }

        },

        mounted () {

            this.renderChart(this.chartdata, this.options)

        }

    }
</script>