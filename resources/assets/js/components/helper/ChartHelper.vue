<script>
    import { Line } from 'vue-chartjs';

    export default {
        extends: Line,
        props: ['labels', 'data', 'title'],
        mounted () {
            this.renderChart({
                labels: this.labels,
                datasets: [
                    {
                        label: this.title,
                        backgroundColor: '#008a88',
                        data: this.data
                    }
                ]
            })
        }
    }
</script>

<style scoped>
    .chartjs-render-monitor {
        width: calc(100vw - 280px);
        max-width: 800px;
    }
</style>