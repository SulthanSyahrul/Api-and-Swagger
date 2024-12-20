@extends('template.main')

@section('content')
<div class="container mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-black">
        Pendapatan Masuk
    </h2>
    <div class="flex flex-col w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between">
            <h5 class="text-lg font-semibold text-gray-800 dark:text-white">Pendapatan</h5>
            <select id="time-interval" class="border rounded px-3 py-1">
                <option value="1d" {{ $interval == '1d' ? 'selected' : '' }}>1 Hari</option>
                <option value="7d" {{ $interval == '7d' ? 'selected' : '' }}>1 Minggu</option>
                <option value="1m" {{ $interval == '1m' ? 'selected' : '' }}>1 Bulan</option>
            </select>
        </div>
        <div id="area-chart" class="w-full"></div>
        <div id="area-chart" class="w-full"></div>
    </div>
</div>

</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () { 
    const pendapatan = @json($pendapatan);
    const labels = @json($labels);

    function organizeData(pendapatan, interval, labels) {
        const seriesData = Array(labels.length).fill(0);
        pendapatan.forEach(function (pesanan) {
            const total = Math.round(pesanan.total_harga);
            const date = new Date(pesanan.updated_at);
            let label = '';

            if (interval === '1d') {
                label = date.getHours() + ':00';
            } else if (interval === '7d') {
                label = date.toLocaleString('id-ID', { weekday: 'long' });
            } else if (interval === '1m') {
                label = 'Minggu ' + Math.ceil(date.getDate() / 7);
            }

            const index = labels.indexOf(label);
            if (index !== -1) {
                seriesData[index] += total;
            }
        });

        return { series: [{ name: "Pendapatan", data: seriesData }], categories: labels };
    }

    const chartData = organizeData(pendapatan, "{{ $interval }}", labels);

    const chartOptions = {
        chart: {
            height: "300px",
            width: "100%",
            type: "area",
            fontFamily: "Inter, sans-serif",
            toolbar: { show: false },
        },
        tooltip: {
            enabled: true,
            y: {
                formatter: function(value) {
                    return Math.round(value);
                }
            },
        },
        fill: {
            type: "gradient",
            gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: "#1C64F2",
                gradientToColors: ["#1C64F2"],
            },
        },
        dataLabels: { enabled: false },
        stroke: { width: 6 },
        grid: { show: false },
        series: chartData.series,
        xaxis: {
            categories: chartData.categories,
            labels: { show: true },
            axisBorder: { show: false },
            axisTicks: { show: false },
        },
        yaxis: { show: true },
    };

    const chartElement = document.getElementById("area-chart");
    let chart = new ApexCharts(chartElement, chartOptions);

    chart.render();

    document.getElementById("time-interval").addEventListener("change", function (e) {
        window.location.href = "/pendapatan?interval=" + e.target.value;
    });
});


</script>
