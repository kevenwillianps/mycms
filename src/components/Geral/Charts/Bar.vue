<script type="text/ecmascript-6">

    import { Bar } from "vue-chartjs";

    export default {

        extends : Bar,

        props : {

            labelP : {

                type: String,
                default : null,

            },

            labelsP : {

                type: Array,
                default : null,

            },

            backgroundColor : {

                type: Array,
                default : null,

            },

            dataP: {

                type: Array,
                default : null,

            }

        },

        data(){

            return {

                chartdata: {

                    labels: this.labelsP,

                    datasets: [

                        {
                            label: this.labelP,
                            backgroundColor: this.backgroundColor,
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