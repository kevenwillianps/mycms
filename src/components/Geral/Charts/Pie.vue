<script type="text/ecmascript-6">

    import { Pie } from "vue-chartjs";

    export default {

        extends : Pie,

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