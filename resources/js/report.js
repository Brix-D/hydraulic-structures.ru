import { Chart, LineController, LineElement, PointElement, CategoryScale, LinearScale, Legend, Tooltip, TimeScale } from 'chart.js';
import 'chartjs-adapter-moment';

Chart.register([LineController, LineElement, PointElement, CategoryScale, LinearScale, Legend, Tooltip, TimeScale]);


const BASE_URL = import.meta.env.VITE_APP_URL;

function createChart(data) {

    const canvas = document.getElementById('reportValue');

    const options = {
        type: 'line',
        data,
        options: {
            elements: {
                line: {
                    spanGaps: true,
                },
            },
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'day'
                    }
                }
            }
        },
    };

    const chart = new Chart(canvas, options);
}

// const reportData = {
//     datasets: [
//         {
//             label: 'Section 1',
//             data: [
//                 {
//                     x: '2023-05-08T14:00',
//                     y: 65
//                 },
//                 {
//                     x: '2023-05-10T18:00',
//                     y: 80
//                 },
//                 {
//                     x: '2023-05-12T14:00',
//                     y: 81
//                 }, 
//                 {
//                     x: '2023-05-14T14:00',
//                     y: 56
//                 },
//             ],
//             borderColor: 'rgb(75, 192, 192)',
//         },
//         {
//             label: 'Section 2',
//             data: [
//                 {
//                     x: '2023-05-08T14:00',
//                     y: 65
//                 },
//                 {
//                     x: '2023-05-10T14:00',
//                     y: 80
//                 },
//                 {
//                     x: '2023-05-11T14:00',
//                     y: 81
//                 }, 
//                 {
//                     x: '2023-05-13T14:00',
//                     y: 56
//                 },
//             ],
//             borderColor: 'rgb(175, 162, 192)',
//         }
//     ],
// };


function getReservoirId() {
    const pathParts = location.pathname.split('/');
    return pathParts[2];
}

async function getChartData(reservoirId) {

    const response = await fetch(`${BASE_URL}/reports/${reservoirId}/chart`);
    if (response.ok) {
        const chartData = await response.json();
        return chartData;
    } else {
        throw new Error('error');
    }
}


function formatChartData(chartData) {
    const report = {
        datasets: [],
    };
    if (Array.isArray(chartData)) {
        report.datasets = chartData.map((section) => {
            const label = `Секция №${section.number}`;
            const data = section.section_measures?.map((measure) => {
                return {
                    x: measure.createdAt,
                    y: measure.value,
                };
            }) ?? [];

            return {
                label,
                data,
                borderColor: section.color ?? '#000000',
            };
        });
    }
    return report;
}

const reservoirId = getReservoirId();

getChartData(reservoirId).then((chartData) => {
   const reportData = formatChartData(chartData.measures);
   createChart(reportData);
}).catch((error) => console.error(error));


