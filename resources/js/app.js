import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import flatpickr from "flatpickr";
import { Japanese } from "flatpickr/dist/l10n/ja.js"

flatpickr("#event_date", {
    "locale": Japanese,
    minDate: "today",
    maxDate: new Date().fp_incr(30)
});


// オプションが全く同じなので、変数を作ってまとめる
const setting = {
    "locale": Japanese,
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
    minTime: "10:00",
    maxTime: "20:30",
}

flatpickr("#start_time",
    // {
    // "locale": Japanese,
    // enableTime: true,
    // noCalendar: true,
    // dateFormat: "H:i",
    // time_24hr: true
    // 同じコードを複数書くので定数化する
    // }
    setting
);

flatpickr("#end_time", setting);
