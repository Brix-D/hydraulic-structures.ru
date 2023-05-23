import { easepick } from '@easepick/core';
import { RangePlugin } from '@easepick/range-plugin';
import css from '@easepick/core/dist/index.css?url';
import rangeCss from '@easepick/range-plugin/dist/index.css?url';

const datepicker = document.getElementById('datepicker');
if (datepicker) {
    const picker = new easepick.create({
        element: datepicker,
        css: [css, rangeCss],
        zIndex: 10,
        plugins: [RangePlugin],
        setup(picker) {
            picker.on('select', (event) => {
                const { start, end } = event.detail;
                const startDate = start.format('YYYY-MM-DD');
                const endDate = end.format('YYYY-MM-DD');
                updateUrl(startDate, endDate);
            });
        },
    });
}

function updateUrl(startDate, endDate) {
    const params = new URLSearchParams(location.search);
    const queryParams = Object.fromEntries(params.entries());

    queryParams.dateFrom = startDate;
    queryParams.dateTo = endDate;

    const newParams = new URLSearchParams(queryParams);

    location.replace(`${location.origin}${location.pathname}?${newParams.toString()}`);
}