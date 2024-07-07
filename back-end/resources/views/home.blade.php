@extends('layout.app')

@section('content')
<div class="flex justify-between mb-8 mt-10 mx-10">
        <h1 class="text-3xl font-bold text-slate-700">Home</h1>
        <div class="flex space-x-2">
        <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Share</button>
        <button class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-700">Export</button>
        
        <button class="px-4 py-2 bg-slate-500 text-white rounded-md hover:bg-slate-700">This week <i class="bi bi-caret-down-fill"></i></button>
        </div>
    </div>

    <div class="relative mx-10">
        <canvas id="myChart" height="600" width="1104"></canvas>
    </div>

    <script>

(() => {
    'use strict'
  
    // Graphs
    const ctx = document.getElementById('myChart')
    // eslint-disable-next-line no-unused-vars
    const myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [
          'Sunday',
          'Monday',
          'Tuesday',
          'Wednesday',
          'Thursday',
          'Friday',
          'Saturday'
        ],
        datasets: [{
          data: [
            15339,
            21345,
            18483,
            24003,
            23489,
            24092,
            12034
          ],
          lineTension: 0,
          backgroundColor: 'transparent',
          borderColor: '#007bff',
          borderWidth: 4,
          pointBackgroundColor: '#007bff'
        }]
      },
      options: {
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            boxPadding: 3
          }
        }
      }
    })
  })()
  
    </script>
@endsection