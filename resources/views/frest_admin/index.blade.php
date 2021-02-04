@extends('admin.layout')

@section('main')

<section id="dashboard-ecommerce">
    <div class="row">
      <!-- Greetings Content Starts -->
      <div class="col-xl-4 col-md-6 col-12 dashboard-greetings">
        <div class="card">
          <div class="card-header">
            <h3 class="greeting-text">Congratulations John!</h3>
            <p class="mb-0">Best seller of the month</p>
          </div>
          <div class="card-content">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-end">
                <div class="dashboard-content-left">
                  <h1 class="text-primary font-large-2 text-bold-500">$89k</h1>
                  <p>You have done 57.6% more sales today.</p>
                  <button type="button" class="btn btn-primary glow">View Sales</button>
                </div>
                <div class="dashboard-content-right">
                  <img src="images/icon/cup.png" height="220" width="220" class="img-fluid" alt="Dashboard Ecommerce">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Multi Radial Chart Starts -->
      <div class="col-xl-4 col-md-6 col-12 dashboard-visit">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Visits of 2019</h4>
            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
          </div>
          <div class="card-content">
            <div class="card-body" style="position: relative;">
              <div id="multi-radial-chart" style="min-height: 218px;"><div id="apexchartsbexoy978" class="apexcharts-canvas apexchartsbexoy978 light" style="width: 594px; height: 218px;"><svg id="SvgjsSvg1277" width="594" height="218.00000000000003" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1279" class="apexcharts-inner apexcharts-graphical" transform="translate(206.5, -10)"><defs id="SvgjsDefs1278"><clipPath id="gridRectMaskbexoy978"><rect id="SvgjsRect1280" width="185" height="207" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMaskbexoy978"><rect id="SvgjsRect1281" width="185" height="207" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath></defs><g id="SvgjsG1283" class="apexcharts-radialbar"><g id="SvgjsG1284"><g id="SvgjsG1285" class="apexcharts-tracks"><g id="SvgjsG1286" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 91.5 24.649999999999977 A 77.85000000000002 77.85000000000002 0 1 1 91.4864126118422 24.650001185723283" fill="none" fill-opacity="1" stroke="rgba(255,255,255,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="3.9770000000000016" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 91.5 24.649999999999977 A 77.85000000000002 77.85000000000002 0 1 1 91.4864126118422 24.650001185723283"></path></g><g id="SvgjsG1288" class="apexcharts-radialbar-track apexcharts-track" rel="2"><path id="apexcharts-radialbarTrack-1" d="M 91.5 38.74999999999997 A 63.75000000000003 63.75000000000003 0 1 1 91.48887352607501 38.75000097096799" fill="none" fill-opacity="1" stroke="rgba(255,255,255,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="3.9770000000000016" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 91.5 38.74999999999997 A 63.75000000000003 63.75000000000003 0 1 1 91.48887352607501 38.75000097096799"></path></g><g id="SvgjsG1290" class="apexcharts-radialbar-track apexcharts-track" rel="3"><path id="apexcharts-radialbarTrack-2" d="M 91.5 52.84999999999997 A 49.65000000000003 49.65000000000003 0 1 1 91.49133444030784 52.850000756212715" fill="none" fill-opacity="1" stroke="rgba(255,255,255,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="3.9770000000000016" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 91.5 52.84999999999997 A 49.65000000000003 49.65000000000003 0 1 1 91.49133444030784 52.850000756212715"></path></g></g><g id="SvgjsG1292"><g id="SvgjsG1297" class="apexcharts-series apexcharts-radial-series" seriesName="Target" rel="1" data:realIndex="0"><path id="SvgjsPath1298" d="M 91.5 24.649999999999977 A 77.85000000000002 77.85000000000002 0 1 1 13.649999999999977 102.50000000000001" fill="none" fill-opacity="0.85" stroke="rgba(90,141,238,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="4.100000000000001" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="270" data:value="75" index="0" j="0" data:pathOrig="M 91.5 24.649999999999977 A 77.85000000000002 77.85000000000002 0 1 1 13.649999999999977 102.50000000000001"></path></g><g id="SvgjsG1299" class="apexcharts-series apexcharts-radial-series" seriesName="Mart" rel="2" data:realIndex="1"><path id="SvgjsPath1300" d="M 91.5 38.74999999999997 A 63.75000000000003 63.75000000000003 0 1 1 30.870147086183934 82.80016660859707" fill="none" fill-opacity="0.85" stroke="rgba(255,91,92,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="4.100000000000001" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-1" data:angle="288" data:value="80" index="0" j="1" data:pathOrig="M 91.5 38.74999999999997 A 63.75000000000003 63.75000000000003 0 1 1 30.870147086183934 82.80016660859707"></path></g><g id="SvgjsG1301" class="apexcharts-series apexcharts-radial-series" seriesName="Ebay" rel="3" data:realIndex="2"><path id="SvgjsPath1302" d="M 91.5 52.84999999999997 A 49.65000000000003 49.65000000000003 0 1 1 51.33230622928384 73.3164622236787" fill="none" fill-opacity="0.85" stroke="rgba(253,172,65,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="4.100000000000001" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-2" data:angle="306" data:value="85" index="0" j="2" data:pathOrig="M 91.5 52.84999999999997 A 49.65000000000003 49.65000000000003 0 1 1 51.33230622928384 73.3164622236787"></path></g><circle id="SvgjsCircle1293" r="42.661500000000004" cx="91.5" cy="102.5" class="apexcharts-radialbar-hollow" fill="transparent"></circle><g id="SvgjsG1294" class="apexcharts-datalabels-group" transform="translate(0, 0)" style="opacity: 1;"><text id="SvgjsText1295" font-family="IBM Plex Sans" x="91.5" y="127.5" text-anchor="middle" dominant-baseline="auto" font-size="15px" fill="#828d99" class="apexcharts-datalabel-label" style="font-family: &quot;IBM Plex Sans&quot;;">Total Visits</text><text id="SvgjsText1296" font-family="Rubik" x="91.5" y="103.5" text-anchor="middle" dominant-baseline="auto" font-size="30px" fill="#373d3f" class="apexcharts-datalabel-value" style="font-family: Rubik;">80%</text></g></g></g></g><line id="SvgjsLine1303" x1="0" y1="0" x2="183" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1304" x1="0" y1="0" x2="183" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line></g></svg><div class="apexcharts-legend"></div></div></div>
              <ul class="list-inline d-flex justify-content-around mb-0">
                <li> <span class="bullet bullet-xs bullet-primary mr-50"></span>Target</li>
                <li> <span class="bullet bullet-xs bullet-danger mr-50"></span>Mart</li>
                <li> <span class="bullet bullet-xs bullet-warning mr-50"></span>Ebay</li>
              </ul>
            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 646px; height: 266px;"></div></div><div class="contract-trigger"></div></div></div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-12 dashboard-users">
        <div class="row  ">
          <!-- Statistics Cards Starts -->
          <div class="col-12">
            <div class="row">
              <div class="col-sm-6 col-12 dashboard-users-success">
                <div class="card text-center">
                  <div class="card-content">
                    <div class="card-body py-1">
                      <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                        <i class="bx bx-briefcase-alt font-medium-5"></i>
                      </div>
                      <div class="text-muted line-ellipsis">New Products</div>
                      <h3 class="mb-0">1.2k</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-12 dashboard-users-danger">
                <div class="card text-center">
                  <div class="card-content">
                    <div class="card-body py-1">
                      <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                        <i class="bx bx-user font-medium-5"></i>
                      </div>
                      <div class="text-muted line-ellipsis">New Users</div>
                      <h3 class="mb-0">45.6k</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-12 col-lg-6 col-12 dashboard-revenue-growth">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center pb-0">
                    <h4 class="card-title">Revenue Growth</h4>
                    <div class="d-flex align-items-end justify-content-end">
                      <span class="mr-25">$25,980</span>
                      <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                    </div>
                  </div>
                  <div class="card-content">
                    <div class="card-body pb-0" style="position: relative;">
                      <div id="revenue-growth-chart" style="min-height: 115px;"><div id="apexcharts6vb78ja7" class="apexcharts-canvas apexcharts6vb78ja7 light" style="width: 594px; height: 100px;"><svg id="SvgjsSvg1307" width="594" height="100" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1309" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 10)"><defs id="SvgjsDefs1308"><linearGradient id="SvgjsLinearGradient1311" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1312" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop><stop id="SvgjsStop1313" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop><stop id="SvgjsStop1314" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop></linearGradient><clipPath id="gridRectMask6vb78ja7"><rect id="SvgjsRect1316" width="594" height="65" x="0" y="0" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMask6vb78ja7"><rect id="SvgjsRect1317" width="596" height="67" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath></defs><rect id="SvgjsRect1315" width="6.6" height="65" x="0" y="0" rx="0" ry="0" fill="url(#SvgjsLinearGradient1311)" opacity="1" stroke-width="0" stroke-dasharray="3" class="apexcharts-xcrosshairs" y2="65" filter="none" fill-opacity="0.9"></rect><g id="SvgjsG1360" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1361" class="apexcharts-xaxis-texts-g" transform="translate(0, -9)"><text id="SvgjsText1362" font-family="Helvetica, Arial, sans-serif" x="16.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1363" style="font-family: Helvetica, Arial, sans-serif;">0</tspan><title>0</title></text><text id="SvgjsText1364" font-family="Helvetica, Arial, sans-serif" x="49.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1365" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text><text id="SvgjsText1366" font-family="Helvetica, Arial, sans-serif" x="82.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1367" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text><text id="SvgjsText1368" font-family="Helvetica, Arial, sans-serif" x="115.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1369" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text><text id="SvgjsText1370" font-family="Helvetica, Arial, sans-serif" x="148.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1371" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text><text id="SvgjsText1372" font-family="Helvetica, Arial, sans-serif" x="181.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1373" style="font-family: Helvetica, Arial, sans-serif;">10</tspan><title>10</title></text><text id="SvgjsText1374" font-family="Helvetica, Arial, sans-serif" x="214.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1375" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text><text id="SvgjsText1376" font-family="Helvetica, Arial, sans-serif" x="247.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1377" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text><text id="SvgjsText1378" font-family="Helvetica, Arial, sans-serif" x="280.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1379" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text><text id="SvgjsText1380" font-family="Helvetica, Arial, sans-serif" x="313.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1381" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text><text id="SvgjsText1382" font-family="Helvetica, Arial, sans-serif" x="346.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1383" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text><text id="SvgjsText1384" font-family="Helvetica, Arial, sans-serif" x="379.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1385" style="font-family: Helvetica, Arial, sans-serif;">15</tspan><title>15</title></text><text id="SvgjsText1386" font-family="Helvetica, Arial, sans-serif" x="412.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1387" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text><text id="SvgjsText1388" font-family="Helvetica, Arial, sans-serif" x="445.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1389" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text><text id="SvgjsText1390" font-family="Helvetica, Arial, sans-serif" x="478.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1391" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text><text id="SvgjsText1392" font-family="Helvetica, Arial, sans-serif" x="511.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1393" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text><text id="SvgjsText1394" font-family="Helvetica, Arial, sans-serif" x="544.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1395" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text><text id="SvgjsText1396" font-family="Helvetica, Arial, sans-serif" x="577.5" y="89" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1397" style="font-family: Helvetica, Arial, sans-serif;">20</tspan><title>20</title></text></g></g><g id="SvgjsG1399" class="apexcharts-grid"><line id="SvgjsLine1401" x1="0" y1="65" x2="594" y2="65" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1400" x1="0" y1="1" x2="0" y2="65" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1319" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG1320" class="apexcharts-series" seriesName="2019" rel="1" data:realIndex="0"><path id="undefined-0" d="M 13.2 65L 13.2 48.75Q 16.5 45.45 19.799999999999997 48.75L 19.799999999999997 65L 13.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 13.2 65L 13.2 48.75Q 16.5 45.45 19.799999999999997 48.75L 19.799999999999997 65L 13.2 65" pathFrom="M 13.2 65L 13.2 65L 19.799999999999997 65L 19.799999999999997 65L 19.799999999999997 65L 13.2 65" cy="48.75" cx="46.2" j="0" val="50" barHeight="16.25" barWidth="6.6"></path><path id="undefined-0" d="M 46.2 65L 46.2 42.25Q 49.5 38.95 52.800000000000004 42.25L 52.800000000000004 65L 46.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 46.2 65L 46.2 42.25Q 49.5 38.95 52.800000000000004 42.25L 52.800000000000004 65L 46.2 65" pathFrom="M 46.2 65L 46.2 65L 52.800000000000004 65L 52.800000000000004 65L 52.800000000000004 65L 46.2 65" cy="42.25" cx="79.2" j="1" val="70" barHeight="22.75" barWidth="6.6"></path><path id="undefined-0" d="M 79.2 65L 79.2 32.5Q 82.5 29.2 85.8 32.5L 85.8 65L 79.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 79.2 65L 79.2 32.5Q 82.5 29.2 85.8 32.5L 85.8 65L 79.2 65" pathFrom="M 79.2 65L 79.2 65L 85.8 65L 85.8 65L 85.8 65L 79.2 65" cy="32.5" cx="112.2" j="2" val="100" barHeight="32.5" barWidth="6.6"></path><path id="undefined-0" d="M 112.2 65L 112.2 26Q 115.5 22.7 118.8 26L 118.8 65L 112.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 112.2 65L 112.2 26Q 115.5 22.7 118.8 26L 118.8 65L 112.2 65" pathFrom="M 112.2 65L 112.2 65L 118.8 65L 118.8 65L 118.8 65L 112.2 65" cy="26" cx="145.2" j="3" val="120" barHeight="39" barWidth="6.6"></path><path id="undefined-0" d="M 145.2 65L 145.2 19.5Q 148.5 16.2 151.79999999999998 19.5L 151.79999999999998 65L 145.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 145.2 65L 145.2 19.5Q 148.5 16.2 151.79999999999998 19.5L 151.79999999999998 65L 145.2 65" pathFrom="M 145.2 65L 145.2 65L 151.79999999999998 65L 151.79999999999998 65L 151.79999999999998 65L 145.2 65" cy="19.5" cx="178.2" j="4" val="140" barHeight="45.5" barWidth="6.6"></path><path id="undefined-0" d="M 178.2 65L 178.2 32.5Q 181.5 29.2 184.79999999999998 32.5L 184.79999999999998 65L 178.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 178.2 65L 178.2 32.5Q 181.5 29.2 184.79999999999998 32.5L 184.79999999999998 65L 178.2 65" pathFrom="M 178.2 65L 178.2 65L 184.79999999999998 65L 184.79999999999998 65L 184.79999999999998 65L 178.2 65" cy="32.5" cx="211.2" j="5" val="100" barHeight="32.5" barWidth="6.6"></path><path id="undefined-0" d="M 211.2 65L 211.2 42.25Q 214.5 38.95 217.79999999999998 42.25L 217.79999999999998 65L 211.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 211.2 65L 211.2 42.25Q 214.5 38.95 217.79999999999998 42.25L 217.79999999999998 65L 211.2 65" pathFrom="M 211.2 65L 211.2 65L 217.79999999999998 65L 217.79999999999998 65L 217.79999999999998 65L 211.2 65" cy="42.25" cx="244.2" j="6" val="70" barHeight="22.75" barWidth="6.6"></path><path id="undefined-0" d="M 244.2 65L 244.2 39Q 247.5 35.7 250.79999999999998 39L 250.79999999999998 65L 244.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 244.2 65L 244.2 39Q 247.5 35.7 250.79999999999998 39L 250.79999999999998 65L 244.2 65" pathFrom="M 244.2 65L 244.2 65L 250.79999999999998 65L 250.79999999999998 65L 250.79999999999998 65L 244.2 65" cy="39" cx="277.2" j="7" val="80" barHeight="26" barWidth="6.6"></path><path id="undefined-0" d="M 277.2 65L 277.2 35.75Q 280.5 32.45 283.8 35.75L 283.8 65L 277.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 277.2 65L 277.2 35.75Q 280.5 32.45 283.8 35.75L 283.8 65L 277.2 65" pathFrom="M 277.2 65L 277.2 65L 283.8 65L 283.8 65L 283.8 65L 277.2 65" cy="35.75" cx="310.2" j="8" val="90" barHeight="29.25" barWidth="6.6"></path><path id="undefined-0" d="M 310.2 65L 310.2 29.25Q 313.5 25.95 316.8 29.25L 316.8 65L 310.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 310.2 65L 310.2 29.25Q 313.5 25.95 316.8 29.25L 316.8 65L 310.2 65" pathFrom="M 310.2 65L 310.2 65L 316.8 65L 316.8 65L 316.8 65L 310.2 65" cy="29.25" cx="343.2" j="9" val="110" barHeight="35.75" barWidth="6.6"></path><path id="undefined-0" d="M 343.2 65L 343.2 48.75Q 346.5 45.45 349.8 48.75L 349.8 65L 343.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 343.2 65L 343.2 48.75Q 346.5 45.45 349.8 48.75L 349.8 65L 343.2 65" pathFrom="M 343.2 65L 343.2 65L 349.8 65L 349.8 65L 349.8 65L 343.2 65" cy="48.75" cx="376.2" j="10" val="50" barHeight="16.25" barWidth="6.6"></path><path id="undefined-0" d="M 376.2 65L 376.2 42.25Q 379.5 38.95 382.8 42.25L 382.8 65L 376.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 376.2 65L 376.2 42.25Q 379.5 38.95 382.8 42.25L 382.8 65L 376.2 65" pathFrom="M 376.2 65L 376.2 65L 382.8 65L 382.8 65L 382.8 65L 376.2 65" cy="42.25" cx="409.2" j="11" val="70" barHeight="22.75" barWidth="6.6"></path><path id="undefined-0" d="M 409.2 65L 409.2 53.625Q 412.5 50.325 415.8 53.625L 415.8 65L 409.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 409.2 65L 409.2 53.625Q 412.5 50.325 415.8 53.625L 415.8 65L 409.2 65" pathFrom="M 409.2 65L 409.2 65L 415.8 65L 415.8 65L 415.8 65L 409.2 65" cy="53.625" cx="442.2" j="12" val="35" barHeight="11.375" barWidth="6.6"></path><path id="undefined-0" d="M 442.2 65L 442.2 29.25Q 445.5 25.95 448.8 29.25L 448.8 65L 442.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 442.2 65L 442.2 29.25Q 445.5 25.95 448.8 29.25L 448.8 65L 442.2 65" pathFrom="M 442.2 65L 442.2 65L 448.8 65L 448.8 65L 448.8 65L 442.2 65" cy="29.25" cx="475.2" j="13" val="110" barHeight="35.75" barWidth="6.6"></path><path id="undefined-0" d="M 475.2 65L 475.2 32.5Q 478.5 29.2 481.8 32.5L 481.8 65L 475.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 475.2 65L 475.2 32.5Q 478.5 29.2 481.8 32.5L 481.8 65L 475.2 65" pathFrom="M 475.2 65L 475.2 65L 481.8 65L 481.8 65L 481.8 65L 475.2 65" cy="32.5" cx="508.2" j="14" val="100" barHeight="32.5" barWidth="6.6"></path><path id="undefined-0" d="M 508.2 65L 508.2 30.875Q 511.5 27.575 514.8 30.875L 514.8 65L 508.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 508.2 65L 508.2 30.875Q 511.5 27.575 514.8 30.875L 514.8 65L 508.2 65" pathFrom="M 508.2 65L 508.2 65L 514.8 65L 514.8 65L 514.8 65L 508.2 65" cy="30.875" cx="541.2" j="15" val="105" barHeight="34.125" barWidth="6.6"></path><path id="undefined-0" d="M 541.2 65L 541.2 24.375Q 544.5 21.075 547.8000000000001 24.375L 547.8000000000001 65L 541.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 541.2 65L 541.2 24.375Q 544.5 21.075 547.8000000000001 24.375L 547.8000000000001 65L 541.2 65" pathFrom="M 541.2 65L 541.2 65L 547.8000000000001 65L 547.8000000000001 65L 547.8000000000001 65L 541.2 65" cy="24.375" cx="574.2" j="16" val="125" barHeight="40.625" barWidth="6.6"></path><path id="undefined-0" d="M 574.2 65L 574.2 39Q 577.5 35.7 580.8000000000001 39L 580.8000000000001 65L 574.2 65" fill="rgba(0,207,221,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 574.2 65L 574.2 39Q 577.5 35.7 580.8000000000001 39L 580.8000000000001 65L 574.2 65" pathFrom="M 574.2 65L 574.2 65L 580.8000000000001 65L 580.8000000000001 65L 580.8000000000001 65L 574.2 65" cy="39" cx="607.2" j="17" val="80" barHeight="26" barWidth="6.6"></path><g id="SvgjsG1321" class="apexcharts-datalabels"></g></g><g id="SvgjsG1340" class="apexcharts-series" seriesName="2018" rel="2" data:realIndex="1"><path id="undefined-1" d="M 13.2 48.75L 13.2 26Q 16.5 22.7 19.799999999999997 26L 19.799999999999997 48.75L 13.2 48.75" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 13.2 48.75L 13.2 26Q 16.5 22.7 19.799999999999997 26L 19.799999999999997 48.75L 13.2 48.75" pathFrom="M 13.2 48.75L 13.2 48.75L 19.799999999999997 48.75L 19.799999999999997 48.75L 19.799999999999997 48.75L 13.2 48.75" cy="26" cx="46.2" j="0" val="70" barHeight="22.75" barWidth="6.6"></path><path id="undefined-1" d="M 46.2 42.25L 46.2 26Q 49.5 22.7 52.800000000000004 26L 52.800000000000004 42.25L 46.2 42.25" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 46.2 42.25L 46.2 26Q 49.5 22.7 52.800000000000004 26L 52.800000000000004 42.25L 46.2 42.25" pathFrom="M 46.2 42.25L 46.2 42.25L 52.800000000000004 42.25L 52.800000000000004 42.25L 52.800000000000004 42.25L 46.2 42.25" cy="26" cx="79.2" j="1" val="50" barHeight="16.25" barWidth="6.6"></path><path id="undefined-1" d="M 79.2 32.5L 79.2 26Q 82.5 22.7 85.8 26L 85.8 32.5L 79.2 32.5" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 79.2 32.5L 79.2 26Q 82.5 22.7 85.8 26L 85.8 32.5L 79.2 32.5" pathFrom="M 79.2 32.5L 79.2 32.5L 85.8 32.5L 85.8 32.5L 85.8 32.5L 79.2 32.5" cy="26" cx="112.2" j="2" val="20" barHeight="6.5" barWidth="6.6"></path><path id="undefined-1" d="M 112.2 26L 112.2 16.25Q 115.5 12.95 118.8 16.25L 118.8 26L 112.2 26" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 112.2 26L 112.2 16.25Q 115.5 12.95 118.8 16.25L 118.8 26L 112.2 26" pathFrom="M 112.2 26L 112.2 26L 118.8 26L 118.8 26L 118.8 26L 112.2 26" cy="16.25" cx="145.2" j="3" val="30" barHeight="9.75" barWidth="6.6"></path><path id="undefined-1" d="M 145.2 19.5L 145.2 13Q 148.5 9.7 151.79999999999998 13L 151.79999999999998 19.5L 145.2 19.5" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 145.2 19.5L 145.2 13Q 148.5 9.7 151.79999999999998 13L 151.79999999999998 19.5L 145.2 19.5" pathFrom="M 145.2 19.5L 145.2 19.5L 151.79999999999998 19.5L 151.79999999999998 19.5L 151.79999999999998 19.5L 145.2 19.5" cy="13" cx="178.2" j="4" val="20" barHeight="6.5" barWidth="6.6"></path><path id="undefined-1" d="M 178.2 32.5L 178.2 3.25Q 181.5 -0.04999999999999982 184.79999999999998 3.25L 184.79999999999998 32.5L 178.2 32.5" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 178.2 32.5L 178.2 3.25Q 181.5 -0.04999999999999982 184.79999999999998 3.25L 184.79999999999998 32.5L 178.2 32.5" pathFrom="M 178.2 32.5L 178.2 32.5L 184.79999999999998 32.5L 184.79999999999998 32.5L 184.79999999999998 32.5L 178.2 32.5" cy="3.25" cx="211.2" j="5" val="90" barHeight="29.25" barWidth="6.6"></path><path id="undefined-1" d="M 211.2 42.25L 211.2 13Q 214.5 9.7 217.79999999999998 13L 217.79999999999998 42.25L 211.2 42.25" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 211.2 42.25L 211.2 13Q 214.5 9.7 217.79999999999998 13L 217.79999999999998 42.25L 211.2 42.25" pathFrom="M 211.2 42.25L 211.2 42.25L 217.79999999999998 42.25L 217.79999999999998 42.25L 217.79999999999998 42.25L 211.2 42.25" cy="13" cx="244.2" j="6" val="90" barHeight="29.25" barWidth="6.6"></path><path id="undefined-1" d="M 244.2 39L 244.2 19.5Q 247.5 16.2 250.79999999999998 19.5L 250.79999999999998 39L 244.2 39" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 244.2 39L 244.2 19.5Q 247.5 16.2 250.79999999999998 19.5L 250.79999999999998 39L 244.2 39" pathFrom="M 244.2 39L 244.2 39L 250.79999999999998 39L 250.79999999999998 39L 250.79999999999998 39L 244.2 39" cy="19.5" cx="277.2" j="7" val="60" barHeight="19.5" barWidth="6.6"></path><path id="undefined-1" d="M 277.2 35.75L 277.2 19.5Q 280.5 16.2 283.8 19.5L 283.8 35.75L 277.2 35.75" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 277.2 35.75L 277.2 19.5Q 280.5 16.2 283.8 19.5L 283.8 35.75L 277.2 35.75" pathFrom="M 277.2 35.75L 277.2 35.75L 283.8 35.75L 283.8 35.75L 283.8 35.75L 277.2 35.75" cy="19.5" cx="310.2" j="8" val="50" barHeight="16.25" barWidth="6.6"></path><path id="undefined-1" d="M 310.2 29.25L 310.2 29.25Q 313.5 25.95 316.8 29.25L 316.8 29.25L 310.2 29.25" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 310.2 29.25L 310.2 29.25Q 313.5 25.95 316.8 29.25L 316.8 29.25L 310.2 29.25" pathFrom="M 310.2 29.25L 310.2 29.25L 316.8 29.25L 316.8 29.25L 316.8 29.25L 310.2 29.25" cy="29.25" cx="343.2" j="9" val="0" barHeight="0" barWidth="6.6"></path><path id="undefined-1" d="M 343.2 48.75L 343.2 32.5Q 346.5 29.2 349.8 32.5L 349.8 48.75L 343.2 48.75" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 343.2 48.75L 343.2 32.5Q 346.5 29.2 349.8 32.5L 349.8 48.75L 343.2 48.75" pathFrom="M 343.2 48.75L 343.2 48.75L 349.8 48.75L 349.8 48.75L 349.8 48.75L 343.2 48.75" cy="32.5" cx="376.2" j="10" val="50" barHeight="16.25" barWidth="6.6"></path><path id="undefined-1" d="M 376.2 42.25L 376.2 22.75Q 379.5 19.45 382.8 22.75L 382.8 42.25L 376.2 42.25" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 376.2 42.25L 376.2 22.75Q 379.5 19.45 382.8 22.75L 382.8 42.25L 376.2 42.25" pathFrom="M 376.2 42.25L 376.2 42.25L 382.8 42.25L 382.8 42.25L 382.8 42.25L 376.2 42.25" cy="22.75" cx="409.2" j="11" val="60" barHeight="19.5" barWidth="6.6"></path><path id="undefined-1" d="M 409.2 53.625L 409.2 8.125Q 412.5 4.825 415.8 8.125L 415.8 53.625L 409.2 53.625" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 409.2 53.625L 409.2 8.125Q 412.5 4.825 415.8 8.125L 415.8 53.625L 409.2 53.625" pathFrom="M 409.2 53.625L 409.2 53.625L 415.8 53.625L 415.8 53.625L 415.8 53.625L 409.2 53.625" cy="8.125" cx="442.2" j="12" val="140" barHeight="45.5" barWidth="6.6"></path><path id="undefined-1" d="M 442.2 29.25L 442.2 13Q 445.5 9.7 448.8 13L 448.8 29.25L 442.2 29.25" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 442.2 29.25L 442.2 13Q 445.5 9.7 448.8 13L 448.8 29.25L 442.2 29.25" pathFrom="M 442.2 29.25L 442.2 29.25L 448.8 29.25L 448.8 29.25L 448.8 29.25L 442.2 29.25" cy="13" cx="475.2" j="13" val="50" barHeight="16.25" barWidth="6.6"></path><path id="undefined-1" d="M 475.2 32.5L 475.2 26Q 478.5 22.7 481.8 26L 481.8 32.5L 475.2 32.5" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 475.2 32.5L 475.2 26Q 478.5 22.7 481.8 26L 481.8 32.5L 475.2 32.5" pathFrom="M 475.2 32.5L 475.2 32.5L 481.8 32.5L 481.8 32.5L 481.8 32.5L 475.2 32.5" cy="26" cx="508.2" j="14" val="20" barHeight="6.5" barWidth="6.6"></path><path id="undefined-1" d="M 508.2 30.875L 508.2 24.375Q 511.5 21.075 514.8 24.375L 514.8 30.875L 508.2 30.875" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 508.2 30.875L 508.2 24.375Q 511.5 21.075 514.8 24.375L 514.8 30.875L 508.2 30.875" pathFrom="M 508.2 30.875L 508.2 30.875L 514.8 30.875L 514.8 30.875L 514.8 30.875L 508.2 30.875" cy="24.375" cx="541.2" j="15" val="20" barHeight="6.5" barWidth="6.6"></path><path id="undefined-1" d="M 541.2 24.375L 541.2 21.125Q 544.5 17.825 547.8000000000001 21.125L 547.8000000000001 24.375L 541.2 24.375" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 541.2 24.375L 541.2 21.125Q 544.5 17.825 547.8000000000001 21.125L 547.8000000000001 24.375L 541.2 24.375" pathFrom="M 541.2 24.375L 541.2 24.375L 547.8000000000001 24.375L 547.8000000000001 24.375L 547.8000000000001 24.375L 541.2 24.375" cy="21.125" cx="574.2" j="16" val="10" barHeight="3.25" barWidth="6.6"></path><path id="undefined-1" d="M 574.2 39L 574.2 39Q 577.5 35.7 580.8000000000001 39L 580.8000000000001 39L 574.2 39" fill="rgba(231,237,243,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask6vb78ja7)" pathTo="M 574.2 39L 574.2 39Q 577.5 35.7 580.8000000000001 39L 580.8000000000001 39L 574.2 39" pathFrom="M 574.2 39L 574.2 39L 580.8000000000001 39L 580.8000000000001 39L 580.8000000000001 39L 574.2 39" cy="39" cx="607.2" j="17" val="0" barHeight="0" barWidth="6.6"></path><g id="SvgjsG1341" class="apexcharts-datalabels"></g></g></g><line id="SvgjsLine1402" x1="0" y1="0" x2="594" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1403" x1="0" y1="0" x2="594" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1404" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1405" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1406" class="apexcharts-point-annotations"></g></g><g id="SvgjsG1398" class="apexcharts-yaxis" rel="0" transform="translate(-21, 0)"></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip light"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(0, 207, 221);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(231, 237, 243);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                    <div class="resize-triggers"><div class="expand-trigger"><div style="width: 646px; height: 116px;"></div></div><div class="contract-trigger"></div></div></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Revenue Growth Chart Starts -->
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-8 col-12 dashboard-order-summary">
        <div class="card">
          <div class="row">
            <!-- Order Summary Starts -->
            <div class="col-md-8 col-12 order-summary border-right pr-md-0">
              <div class="card mb-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h4 class="card-title">Order Summary</h4>
                  <div class="d-flex">
                    <button type="button" class="btn btn-sm btn-light-primary mr-1">Month</button>
                    <button type="button" class="btn btn-sm btn-primary glow">Week</button>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body p-0" style="position: relative;">
                    <div id="order-summary-chart" style="min-height: 270px;"><div id="apexcharts3n2icibof" class="apexcharts-canvas apexcharts3n2icibof light" style="width: 645px; height: 270px;"><svg id="SvgjsSvg1411" width="645" height="270" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1413" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1412"><clipPath id="gridRectMask3n2icibof"><rect id="SvgjsRect1417" width="647.5" height="272.5" x="-1.25" y="-1.25" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMask3n2icibof"><rect id="SvgjsRect1418" width="647" height="272" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><linearGradient id="SvgjsLinearGradient1424" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1425" stop-opacity="0.7" stop-color="rgba(90,141,238,0.7)" offset="0"></stop><stop id="SvgjsStop1426" stop-opacity="0.55" stop-color="rgba(226,236,255,0.55)" offset="0.8"></stop><stop id="SvgjsStop1427" stop-opacity="0.55" stop-color="rgba(226,236,255,0.55)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient1434" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1435" stop-opacity="0.7" stop-color="rgba(90,141,238,0.7)" offset="0"></stop><stop id="SvgjsStop1436" stop-opacity="0.55" stop-color="rgba(90,141,238,0.55)" offset="0.8"></stop><stop id="SvgjsStop1437" stop-opacity="0.55" stop-color="rgba(90,141,238,0.55)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1416" x1="0" y1="0" x2="0" y2="270" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="270" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1439" class="apexcharts-xaxis" transform="translate(0, -50)"><g id="SvgjsG1440" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1441" font-family="Helvetica, Arial, sans-serif" x="0" y="299" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1442" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text><text id="SvgjsText1443" font-family="Helvetica, Arial, sans-serif" x="64.5" y="299" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1444" style="font-family: Helvetica, Arial, sans-serif;">1</tspan><title>1</title></text><text id="SvgjsText1445" font-family="Helvetica, Arial, sans-serif" x="129" y="299" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1446" style="font-family: Helvetica, Arial, sans-serif;">2</tspan><title>2</title></text><text id="SvgjsText1447" font-family="Helvetica, Arial, sans-serif" x="193.5" y="299" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1448" style="font-family: Helvetica, Arial, sans-serif;">3</tspan><title>3</title></text><text id="SvgjsText1449" font-family="Helvetica, Arial, sans-serif" x="258" y="299" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1450" style="font-family: Helvetica, Arial, sans-serif;">4</tspan><title>4</title></text><text id="SvgjsText1451" font-family="Helvetica, Arial, sans-serif" x="322.5" y="299" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1452" style="font-family: Helvetica, Arial, sans-serif;">5</tspan><title>5</title></text><text id="SvgjsText1453" font-family="Helvetica, Arial, sans-serif" x="387" y="299" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1454" style="font-family: Helvetica, Arial, sans-serif;">6</tspan><title>6</title></text><text id="SvgjsText1455" font-family="Helvetica, Arial, sans-serif" x="451.5" y="299" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1456" style="font-family: Helvetica, Arial, sans-serif;">7</tspan><title>7</title></text><text id="SvgjsText1457" font-family="Helvetica, Arial, sans-serif" x="516" y="299" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1458" style="font-family: Helvetica, Arial, sans-serif;">8</tspan><title>8</title></text><text id="SvgjsText1459" font-family="Helvetica, Arial, sans-serif" x="580.5" y="299" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1460" style="font-family: Helvetica, Arial, sans-serif;">9</tspan><title>9</title></text><text id="SvgjsText1461" font-family="Helvetica, Arial, sans-serif" x="645" y="299" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#828d99" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1462" style="font-family: Helvetica, Arial, sans-serif;"></tspan><title></title></text></g></g><g id="SvgjsG1465" class="apexcharts-grid"><line id="SvgjsLine1467" x1="0" y1="270" x2="645" y2="270" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1466" x1="0" y1="1" x2="0" y2="270" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1420" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1421" class="apexcharts-series" seriesName="Weeks" data:longestSeries="true" rel="1" data:realIndex="0"><path id="undefined-0" d="M 0 270L 0 135C 22.575 135 41.925 96.42857142857144 64.5 96.42857142857144C 87.075 96.42857142857144 106.425 146.57142857142856 129 146.57142857142856C 151.575 146.57142857142856 170.925 104.14285714285711 193.5 104.14285714285711C 216.075 104.14285714285711 235.425 154.28571428571422 258 154.28571428571422C 280.575 154.28571428571422 299.925 19.28571428571422 322.5 19.28571428571422C 345.075 19.28571428571422 364.425 154.28571428571422 387 154.28571428571422C 409.575 154.28571428571422 428.925 115.71428571428567 451.5 115.71428571428567C 474.075 115.71428571428567 493.425 154.28571428571422 516 154.28571428571422C 538.575 154.28571428571422 557.925 38.571428571428555 580.5 38.571428571428555C 603.075 38.571428571428555 622.425 77.14285714285711 645 77.14285714285711C 645 77.14285714285711 645 77.14285714285711 645 270M 645 77.14285714285711z" fill="url(#SvgjsLinearGradient1424)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask3n2icibof)" pathTo="M 0 270L 0 135C 22.575 135 41.925 96.42857142857144 64.5 96.42857142857144C 87.075 96.42857142857144 106.425 146.57142857142856 129 146.57142857142856C 151.575 146.57142857142856 170.925 104.14285714285711 193.5 104.14285714285711C 216.075 104.14285714285711 235.425 154.28571428571422 258 154.28571428571422C 280.575 154.28571428571422 299.925 19.28571428571422 322.5 19.28571428571422C 345.075 19.28571428571422 364.425 154.28571428571422 387 154.28571428571422C 409.575 154.28571428571422 428.925 115.71428571428567 451.5 115.71428571428567C 474.075 115.71428571428567 493.425 154.28571428571422 516 154.28571428571422C 538.575 154.28571428571422 557.925 38.571428571428555 580.5 38.571428571428555C 603.075 38.571428571428555 622.425 77.14285714285711 645 77.14285714285711C 645 77.14285714285711 645 77.14285714285711 645 270M 645 77.14285714285711z" pathFrom="M -1 771.4285714285714L -1 771.4285714285714L 64.5 771.4285714285714L 129 771.4285714285714L 193.5 771.4285714285714L 258 771.4285714285714L 322.5 771.4285714285714L 387 771.4285714285714L 451.5 771.4285714285714L 516 771.4285714285714L 580.5 771.4285714285714L 645 771.4285714285714"></path><path id="undefined-0" d="M 0 135C 22.575 135 41.925 96.42857142857144 64.5 96.42857142857144C 87.075 96.42857142857144 106.425 146.57142857142856 129 146.57142857142856C 151.575 146.57142857142856 170.925 104.14285714285711 193.5 104.14285714285711C 216.075 104.14285714285711 235.425 154.28571428571422 258 154.28571428571422C 280.575 154.28571428571422 299.925 19.28571428571422 322.5 19.28571428571422C 345.075 19.28571428571422 364.425 154.28571428571422 387 154.28571428571422C 409.575 154.28571428571422 428.925 115.71428571428567 451.5 115.71428571428567C 474.075 115.71428571428567 493.425 154.28571428571422 516 154.28571428571422C 538.575 154.28571428571422 557.925 38.571428571428555 580.5 38.571428571428555C 603.075 38.571428571428555 622.425 77.14285714285711 645 77.14285714285711" fill="none" fill-opacity="1" stroke="#5a8dee" stroke-opacity="1" stroke-linecap="butt" stroke-width="2.5" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask3n2icibof)" pathTo="M 0 135C 22.575 135 41.925 96.42857142857144 64.5 96.42857142857144C 87.075 96.42857142857144 106.425 146.57142857142856 129 146.57142857142856C 151.575 146.57142857142856 170.925 104.14285714285711 193.5 104.14285714285711C 216.075 104.14285714285711 235.425 154.28571428571422 258 154.28571428571422C 280.575 154.28571428571422 299.925 19.28571428571422 322.5 19.28571428571422C 345.075 19.28571428571422 364.425 154.28571428571422 387 154.28571428571422C 409.575 154.28571428571422 428.925 115.71428571428567 451.5 115.71428571428567C 474.075 115.71428571428567 493.425 154.28571428571422 516 154.28571428571422C 538.575 154.28571428571422 557.925 38.571428571428555 580.5 38.571428571428555C 603.075 38.571428571428555 622.425 77.14285714285711 645 77.14285714285711" pathFrom="M -1 771.4285714285714L -1 771.4285714285714L 64.5 771.4285714285714L 129 771.4285714285714L 193.5 771.4285714285714L 258 771.4285714285714L 322.5 771.4285714285714L 387 771.4285714285714L 451.5 771.4285714285714L 516 771.4285714285714L 580.5 771.4285714285714L 645 771.4285714285714"></path><g id="SvgjsG1422" class="apexcharts-series-markers-wrap"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1473" r="0" cx="0" cy="0" class="apexcharts-marker wfs70dthy" stroke="#ffffff" fill="#5a8dee" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g><g id="SvgjsG1423" class="apexcharts-datalabels"></g></g></g><g id="SvgjsG1430" class="apexcharts-line-series apexcharts-plot-series"><g id="SvgjsG1431" class="apexcharts-series" seriesName="Months" data:longestSeries="true" rel="1" data:realIndex="1"><path id="undefined-0" d="M 0 123.42857142857144C 22.575 123.42857142857144 41.925 123.42857142857144 64.5 123.42857142857144C 87.075 123.42857142857144 106.425 173.57142857142856 129 173.57142857142856C 151.575 173.57142857142856 170.925 84.85714285714289 193.5 84.85714285714289C 216.075 84.85714285714289 235.425 173.57142857142856 258 173.57142857142856C 280.575 173.57142857142856 299.925 115.71428571428567 322.5 115.71428571428567C 345.075 115.71428571428567 364.425 38.571428571428555 387 38.571428571428555C 409.575 38.571428571428555 428.925 154.28571428571422 451.5 154.28571428571422C 474.075 154.28571428571422 493.425 192.8571428571429 516 192.8571428571429C 538.575 192.8571428571429 557.925 115.71428571428567 580.5 115.71428571428567C 603.075 115.71428571428567 622.425 231.42857142857144 645 231.42857142857144" fill="none" fill-opacity="1" stroke="url(#SvgjsLinearGradient1434)" stroke-opacity="1" stroke-linecap="butt" stroke-width="2.5" stroke-dasharray="8" class="apexcharts-line" index="1" clip-path="url(#gridRectMask3n2icibof)" pathTo="M 0 123.42857142857144C 22.575 123.42857142857144 41.925 123.42857142857144 64.5 123.42857142857144C 87.075 123.42857142857144 106.425 173.57142857142856 129 173.57142857142856C 151.575 173.57142857142856 170.925 84.85714285714289 193.5 84.85714285714289C 216.075 84.85714285714289 235.425 173.57142857142856 258 173.57142857142856C 280.575 173.57142857142856 299.925 115.71428571428567 322.5 115.71428571428567C 345.075 115.71428571428567 364.425 38.571428571428555 387 38.571428571428555C 409.575 38.571428571428555 428.925 154.28571428571422 451.5 154.28571428571422C 474.075 154.28571428571422 493.425 192.8571428571429 516 192.8571428571429C 538.575 192.8571428571429 557.925 115.71428571428567 580.5 115.71428571428567C 603.075 115.71428571428567 622.425 231.42857142857144 645 231.42857142857144" pathFrom="M -1 771.4285714285714L -1 771.4285714285714L 64.5 771.4285714285714L 129 771.4285714285714L 193.5 771.4285714285714L 258 771.4285714285714L 322.5 771.4285714285714L 387 771.4285714285714L 451.5 771.4285714285714L 516 771.4285714285714L 580.5 771.4285714285714L 645 771.4285714285714"></path><g id="SvgjsG1432" class="apexcharts-series-markers-wrap"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1474" r="0" cx="0" cy="0" class="apexcharts-marker wxtejbqbnh" stroke="#ffffff" fill="#5a8dee" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g><g id="SvgjsG1433" class="apexcharts-datalabels"></g></g></g><line id="SvgjsLine1468" x1="0" y1="0" x2="645" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1469" x1="0" y1="0" x2="645" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1470" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1471" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1472" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1415" width="0" height="0" x="0" y="0" rx="0" ry="0" fill="#fefefe" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect><g id="SvgjsG1463" class="apexcharts-yaxis" rel="0" transform="translate(-21, 0)"><g id="SvgjsG1464" class="apexcharts-yaxis-texts-g"></g></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip light"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(90, 141, 238);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(90, 141, 238);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                  <div class="resize-triggers"><div class="expand-trigger"><div style="width: 646px; height: 271px;"></div></div><div class="contract-trigger"></div></div></div>
                </div>
              </div>
            </div>
            <!-- Sales History Starts -->
            <div class="col-md-4 col-12 pl-md-0">
              <div class="card mb-0">
                <div class="card-header pb-50">
                  <h4 class="card-title">Sales History</h4>
                </div>
                <div class="card-content">
                  <div class="card-body py-1">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <div class="sales-item-name">
                        <p class="mb-0">Airpods</p>
                        <small class="text-muted">30 min ago</small>
                      </div>
                      <div class="sales-item-amount">
                        <h6 class="mb-0"><span class="text-success">+</span> $50</h6>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <div class="sales-item-name">
                        <p class="mb-0">iPhone</p>
                        <small class="text-muted">2 hour ago</small>
                      </div>
                      <div class="sales-item-amount">
                        <h6 class="mb-0"><span class="text-danger">-</span> $59</h6>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="sales-item-name">
                        <p class="mb-0">Macbook</p>
                        <small class="text-muted">1 day ago</small>
                      </div>
                      <div class="sales-item-amount">
                        <h6 class="mb-0"><span class="text-success">+</span> $12</h6>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer border-top pb-0">
                    <h5>Total Sales</h5>
                    <span class="text-primary text-bold-500">$82,950.96</span>
                    <div class="progress progress-bar-primary progress-sm my-50">
                      <div class="progress-bar" role="progressbar" aria-valuenow="78" style="width:78%"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Latest Update Starts -->
      <div class="col-xl-4 col-md-6 col-12 dashboard-latest-update">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center pb-50">
            <h4 class="card-title">Latest Update</h4>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButtonSec" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                2019
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonSec">
                <a class="dropdown-item" href="#">2019</a>
                <a class="dropdown-item" href="#">2018</a>
                <a class="dropdown-item" href="#">2017</a>
              </div>
            </div>
          </div>
          <div class="card-content">
            <div class="card-body p-0 pb-1 ps ps--active-y">
              <ul class="list-group list-group-flush">
                <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                  <div class="list-left d-flex">
                    <div class="list-icon mr-1">
                      <div class="avatar bg-rgba-primary m-0">
                        <div class="avatar-content">
                          <i class="bx bxs-zap text-primary font-size-base"></i>
                        </div>
                      </div>
                    </div>
                    <div class="list-content">
                      <span class="list-title">Total Products</span>
                      <small class="text-muted d-block">1.2k New Products</small>
                    </div>
                  </div>
                  <span>10.6k</span>
                </li>
                <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                  <div class="list-left d-flex">
                    <div class="list-icon mr-1">
                      <div class="avatar bg-rgba-info m-0">
                        <div class="avatar-content">
                          <i class="bx bx-stats text-info font-size-base"></i>
                        </div>
                      </div>
                    </div>
                    <div class="list-content">
                      <span class="list-title">Total Sales</span>
                      <small class="text-muted d-block">39.4k New Sales</small>
                    </div>
                  </div>
                  <span>26M</span>
                </li>
                <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                  <div class="list-left d-flex">
                    <div class="list-icon mr-1">
                      <div class="avatar bg-rgba-danger m-0">
                        <div class="avatar-content">
                          <i class="bx bx-credit-card text-danger font-size-base"></i>
                        </div>
                      </div>
                    </div>
                    <div class="list-content">
                      <span class="list-title">Total Revenue</span>
                      <small class="text-muted d-block">43.5k New Revenue</small>
                    </div>
                  </div>
                  <span>15.89M</span>
                </li>
                <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                  <div class="list-left d-flex">
                    <div class="list-icon mr-1">
                      <div class="avatar bg-rgba-success m-0">
                        <div class="avatar-content">
                          <i class="bx bx-dollar text-success font-size-base"></i>
                        </div>
                      </div>
                    </div>
                    <div class="list-content">
                      <span class="list-title">Total Cost</span>
                      <small class="text-muted d-block">Total Expenses</small>
                    </div>
                  </div>
                  <span>1.25B</span>
                </li>
                <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                  <div class="list-left d-flex">
                    <div class="list-icon mr-1">
                      <div class="avatar bg-rgba-primary m-0">
                        <div class="avatar-content">
                          <i class="bx bx-user text-primary font-size-base"></i>
                        </div>
                      </div>
                    </div>
                    <div class="list-content">
                      <span class="list-title">Total Users</span>
                      <small class="text-muted d-block">New Users</small>
                    </div>
                  </div>
                  <span>1.2k</span>
                </li>
                <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                  <div class="list-left d-flex">
                    <div class="list-icon mr-1">
                      <div class="avatar bg-rgba-danger m-0">
                        <div class="avatar-content">
                          <i class="bx bx-edit-alt text-danger font-size-base"></i>
                        </div>
                      </div>
                    </div>
                    <div class="list-content">
                      <span class="list-title">Total Visits</span>
                      <small class="text-muted d-block">New Visits</small>
                    </div>
                  </div>
                  <span>4.6k</span>
                </li>
              </ul>
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 280px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 190px;"></div></div></div>
          </div>
        </div>
      </div>
      <!-- Earning Swiper Starts -->
      <div class="col-xl-4 col-md-6 col-12 dashboard-earning-swiper" id="widget-earnings">
        <div class="card">
          <div class="card-header border-bottom d-flex justify-content-between align-items-center">
            <h5 class="card-title"><i class="bx bx-dollar font-medium-5 align-middle"></i> <span class="align-middle">Earnings</span></h5>
            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
          </div>
          <div class="card-content">
            <div class="card-body py-1 px-0">
              <!-- earnings swiper starts -->
              <div class="widget-earnings-swiper swiper-container p-1 swiper-container-initialized swiper-container-horizontal">
                <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(-266.797px, 0px, 0px);">
                  <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="repo-design" style="margin-right: 30px;">
                    <i class="bx bx-pyramid mr-1 font-weight-normal font-medium-4"></i>
                    <div class="swiper-text">
                      <div class="swiper-heading">Repo Design</div>
                      <small class="d-block">Gitlab</small>
                    </div>
                  </div>
                  <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center swiper-slide-prev" id="laravel-temp" style="margin-right: 30px;">
                    <i class="bx bx-sitemap mr-50 font-large-1"></i>
                    <div class="swiper-text">
                      <div class="swiper-heading">Designer</div>
                      <small class="d-block">Women Clothes</small>
                    </div>
                  </div>
                  <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center swiper-slide-active" id="admin-theme" style="margin-right: 30px;">
                    <i class="bx bx-check-shield mr-50 font-large-1"></i>
                    <div class="swiper-text">
                      <div class="swiper-heading">Best Sellers</div>
                      <small class="d-block">Clothing</small>
                    </div>
                  </div>
                  <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center swiper-slide-next" id="ux-devloper" style="margin-right: 30px;">
                    <i class="bx bx-devices mr-50 font-large-1"></i>
                    <div class="swiper-text">
                      <div class="swiper-heading">Admin Template</div>
                      <small class="d-block">Global Network</small>
                    </div>
                  </div>
                  <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="marketing-guide" style="margin-right: 30px;">
                    <i class="bx bx-book-bookmark mr-50 font-large-1"></i>
                    <div class="swiper-text">
                      <div class="swiper-heading">Marketing Guide</div>
                      <small class="d-block">Books</small>
                    </div>
                  </div>
                </div>
              <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
              <!-- earnings swiper ends -->
            </div>
          </div>
          <div class="main-wrapper-content">
            <div class="wrapper-content" data-earnings="repo-design">
              <div class="widget-earnings-scroll table-responsive ps">
                <table class="table table-borderless widget-earnings-width mb-0">
                  <tbody>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-10.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Jerry Lter</h6>
                            <span class="font-small-2">Designer</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-info progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="80" aria-valuemax="100" style="width:33%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-warning">- $280</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-11.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Pauly uez</h6>
                            <span class="font-small-2">Devloper</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-success progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="80" aria-valuemax="100" style="width:10%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-success">+ $853</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-11.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Lary Masey</h6>
                            <span class="font-small-2">Marketing</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-primary progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80" aria-valuemax="100" style="width:15%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-primary">+ $125</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-12.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Lula Taylor</h6>
                            <span class="font-small-2">Degigner</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-danger progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="80" aria-valuemax="100" style="width:35%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-danger">- $310</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
            </div>
            <div class="wrapper-content" data-earnings="laravel-temp">
              <div class="widget-earnings-scroll table-responsive">
                <table class="table table-borderless widget-earnings-width mb-0">
                  <tbody>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-9.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Jesus Lter</h6>
                            <span class="font-small-2">Designer</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-info progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="28" aria-valuemin="80" aria-valuemax="100" style="width:28%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-info">- $280</span></td>
                    </tr>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-10.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Pauly Dez</h6>
                            <span class="font-small-2">Devloper</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-success progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="80" aria-valuemax="100" style="width:90%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-success">+ $83</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-11.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Lary Masey</h6>
                            <span class="font-small-2">Marketing</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-primary progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80" aria-valuemax="100" style="width:15%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-primary">+ $125</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-12.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Lula Taylor</h6>
                            <span class="font-small-2">Devloper</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-danger progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="80" aria-valuemax="100" style="width:35%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-danger">- $310</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="wrapper-content active" data-earnings="admin-theme">
              <div class="widget-earnings-scroll table-responsive">
                <table class="table table-borderless widget-earnings-width mb-0">
                  <tbody>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-25.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Mera Lter</h6>
                            <span class="font-small-2">Designer</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-info progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="52" aria-valuemin="80" aria-valuemax="100" style="width:52%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-info">- $180</span></td>
                    </tr>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-15.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Pauly Dez</h6>
                            <span class="font-small-2">Devloper</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-success progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="80" aria-valuemax="100" style="width:90%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-success">+ $553</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-11.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">jini mara</h6>
                            <span class="font-small-2">Marketing</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-primary progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80" aria-valuemax="100" style="width:15%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-primary">+ $125</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-12.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Lula Taylor</h6>
                            <span class="font-small-2">UX</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-danger progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="80" aria-valuemax="100" style="width:35%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-danger">- $150</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="wrapper-content" data-earnings="ux-devloper">
              <div class="widget-earnings-scroll table-responsive">
                <table class="table table-borderless widget-earnings-width mb-0">
                  <tbody>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-16.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Drako Lter</h6>
                            <span class="font-small-2">Designer</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-info progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="38" aria-valuemin="80" aria-valuemax="100" style="width:38%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-danger">- $280</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-1.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Pauly Dez</h6>
                            <span class="font-small-2">Devloper</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-success progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="80" aria-valuemax="100" style="width:90%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-success">+ $853</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-11.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Lary Masey</h6>
                            <span class="font-small-2">Marketing</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-primary progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80" aria-valuemax="100" style="width:15%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-primary">+ $125</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-2.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Lvia Taylor</h6>
                            <span class="font-small-2">Devloper</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-danger progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="80" aria-valuemax="100" style="width:75%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-danger">- $360</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="wrapper-content" data-earnings="marketing-guide">
              <div class="widget-earnings-scroll table-responsive">
                <table class="table table-borderless widget-earnings-width mb-0">
                  <tbody>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-19.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">yono Lter</h6>
                            <span class="font-small-2">Designer</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-info progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="28" aria-valuemin="80" aria-valuemax="100" style="width:28%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-primary">- $270</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-11.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Pauly Dez</h6>
                            <span class="font-small-2">Devloper</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-success progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="80" aria-valuemax="100" style="width:90%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-success">+ $853</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-12.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Lary Masey</h6>
                            <span class="font-small-2">Marketing</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-primary progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80" aria-valuemax="100" style="width:15%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-primary">+ $225</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-75">
                        <div class="media align-items-center">
                          <a class="media-left mr-50" href="#">
                            <img src="images/portrait/small/avatar-s-25.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                          </a>
                          <div class="media-body">
                            <h6 class="media-heading mb-0">Lula Taylor</h6>
                            <span class="font-small-2">Devloper</span>
                          </div>
                        </div>
                      </td>
                      <td class="px-0 w-25">
                        <div class="progress progress-bar-danger progress-sm mb-0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="80" aria-valuemax="100" style="width:35%;"></div>
                        </div>
                      </td>
                      <td class="text-center"><span class="badge badge-light-danger">- $350</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Marketing Campaigns Starts -->
      <div class="col-xl-8 col-12 dashboard-marketing-campaign">
        <div class="card marketing-campaigns">
          <div class="card-header d-flex justify-content-between align-items-center pb-1">
            <h4 class="card-title">Marketing campaigns</h4>
            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
          </div>
          <div class="card-content">
            <div class="card-body pb-0">
              <div class="row">
                <div class="col-md-9 col-12">
                  <div class="d-inline-block">
                    <!-- chart-1   -->
                    <div class="d-flex market-statistics-1" style="position: relative;">
                      <!-- chart-statistics-1 -->
                      <div id="donut-success-chart" style="min-height: 74.7073px;"><div id="apexchartsljzpfhjff" class="apexcharts-canvas apexchartsljzpfhjff light" style="width: 80px; height: 74.7073px;"><svg id="SvgjsSvg1237" width="80" height="74.70731707317074" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1239" class="apexcharts-inner apexcharts-graphical" transform="translate(14.5, 15)"><defs id="SvgjsDefs1238"><clipPath id="gridRectMaskljzpfhjff"><rect id="SvgjsRect1240" width="55" height="77" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMaskljzpfhjff"><rect id="SvgjsRect1241" width="55" height="77" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath></defs><g id="SvgjsG1243" class="apexcharts-pie" data:innerTranslateX="0" data:innerTranslateY="-25"><g id="SvgjsG1244" transform="translate(0, -5) scale(1)"><circle id="SvgjsCircle1245" r="13.897560975609759" cx="26.5" cy="26.5" fill="transparent"></circle><g id="SvgjsG1246" class="apexcharts-slices"><g id="SvgjsG1247" class="apexcharts-series apexcharts-pie-series" seriesName="Installation" rel="1" data:realIndex="0"><path id="SvgjsPath1248" d="M 26.5 6.6463414634146325 A 19.853658536585368 19.853658536585368 0 0 1 26.5 46.35365853658537 L 26.5 40.39756097560976 A 13.897560975609759 13.897560975609759 0 0 0 26.5 12.602439024390241 L 26.5 6.6463414634146325 z" fill="rgba(253,172,65,1)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="180" data:startAngle="0" data:strokeWidth="2" data:value="70" data:pathOrig="M 26.5 6.6463414634146325 A 19.853658536585368 19.853658536585368 0 0 1 26.5 46.35365853658537 L 26.5 40.39756097560976 A 13.897560975609759 13.897560975609759 0 0 0 26.5 12.602439024390241 L 26.5 6.6463414634146325 z"></path></g><g id="SvgjsG1249" class="apexcharts-series apexcharts-pie-series" seriesName="PagexViews" rel="2" data:realIndex="1"><path id="SvgjsPath1250" d="M 26.5 46.35365853658537 A 19.853658536585368 19.853658536585368 0 0 1 7.144114133755991 30.91785464001074 L 12.950879893629192 29.59249824800752 A 13.897560975609759 13.897560975609759 0 0 0 26.5 40.39756097560976 L 26.5 46.35365853658537 z" fill="rgba(0,207,221,1)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="77.14285714285711" data:startAngle="180" data:strokeWidth="2" data:value="30" data:pathOrig="M 26.5 46.35365853658537 A 19.853658536585368 19.853658536585368 0 0 1 7.144114133755991 30.91785464001074 L 12.950879893629192 29.59249824800752 A 13.897560975609759 13.897560975609759 0 0 0 26.5 40.39756097560976 L 26.5 46.35365853658537 z"></path></g><g id="SvgjsG1251" class="apexcharts-series apexcharts-pie-series" seriesName="ActivexUsers" rel="3" data:realIndex="2"><path id="SvgjsPath1252" d="M 7.144114133755991 30.91785464001074 A 19.853658536585368 19.853658536585368 0 0 1 26.496534882917288 6.646341765803143 L 26.497574418042102 12.602439236062198 A 13.897560975609759 13.897560975609759 0 0 0 12.950879893629192 29.59249824800752 L 7.144114133755991 30.91785464001074 z" fill="rgba(90,141,238,1)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="102.85714285714289" data:startAngle="257.1428571428571" data:strokeWidth="2" data:value="40" data:pathOrig="M 7.144114133755991 30.91785464001074 A 19.853658536585368 19.853658536585368 0 0 1 26.496534882917288 6.646341765803143 L 26.497574418042102 12.602439236062198 A 13.897560975609759 13.897560975609759 0 0 0 12.950879893629192 29.59249824800752 L 7.144114133755991 30.91785464001074 z"></path></g></g></g></g><line id="SvgjsLine1253" x1="0" y1="0" x2="53" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1254" x1="0" y1="0" x2="53" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip dark"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(253, 172, 65);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(0, 207, 221);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(90, 141, 238);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                      <!-- data -->
                      <div class="statistics-data my-auto">
                        <div class="statistics">
                          <span class="font-medium-2 mr-50 text-bold-600">25,756</span><span class="text-success">(+16.2%)</span>
                        </div>
                        <div class="statistics-date">
                          <i class="bx bx-radio-circle font-small-1 text-success mr-25"></i>
                          <small class="text-muted">May 12, 2019</small>
                        </div>
                      </div>
                    <div class="resize-triggers"><div class="expand-trigger"><div style="width: 214px; height: 76px;"></div></div><div class="contract-trigger"></div></div></div>
                  </div>
                  <div class="d-inline-block">
                    <!-- chart-2 -->
                    <div class="d-flex mb-75 market-statistics-2" style="position: relative;">
                      <!-- chart statistics-2 -->
                      <div id="donut-danger-chart" style="min-height: 74.7073px;"><div id="apexchartssrwova3g" class="apexcharts-canvas apexchartssrwova3g light" style="width: 80px; height: 74.7073px;"><svg id="SvgjsSvg1257" width="80" height="74.70731707317074" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1259" class="apexcharts-inner apexcharts-graphical" transform="translate(14.5, 15)"><defs id="SvgjsDefs1258"><clipPath id="gridRectMasksrwova3g"><rect id="SvgjsRect1260" width="55" height="77" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMasksrwova3g"><rect id="SvgjsRect1261" width="55" height="77" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath></defs><g id="SvgjsG1263" class="apexcharts-pie" data:innerTranslateX="0" data:innerTranslateY="-25"><g id="SvgjsG1264" transform="translate(0, -5) scale(1)"><circle id="SvgjsCircle1265" r="13.897560975609759" cx="26.5" cy="26.5" fill="transparent"></circle><g id="SvgjsG1266" class="apexcharts-slices"><g id="SvgjsG1267" class="apexcharts-series apexcharts-pie-series" seriesName="Installation" rel="1" data:realIndex="0"><path id="SvgjsPath1268" d="M 26.5 6.6463414634146325 A 19.853658536585368 19.853658536585368 0 0 1 26.5 46.35365853658537 L 26.5 40.39756097560976 A 13.897560975609759 13.897560975609759 0 0 0 26.5 12.602439024390241 L 26.5 6.6463414634146325 z" fill="rgba(255,91,92,1)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="180" data:startAngle="0" data:strokeWidth="2" data:value="70" data:pathOrig="M 26.5 6.6463414634146325 A 19.853658536585368 19.853658536585368 0 0 1 26.5 46.35365853658537 L 26.5 40.39756097560976 A 13.897560975609759 13.897560975609759 0 0 0 26.5 12.602439024390241 L 26.5 6.6463414634146325 z"></path></g><g id="SvgjsG1269" class="apexcharts-series apexcharts-pie-series" seriesName="PagexViews" rel="2" data:realIndex="1"><path id="SvgjsPath1270" d="M 26.5 46.35365853658537 A 19.853658536585368 19.853658536585368 0 0 1 7.144114133755991 22.082145359989255 L 12.950879893629192 23.407501751992477 A 13.897560975609759 13.897560975609759 0 0 0 26.5 40.39756097560976 L 26.5 46.35365853658537 z" fill="rgba(130,141,153,1)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="102.85714285714289" data:startAngle="180" data:strokeWidth="2" data:value="40" data:pathOrig="M 26.5 46.35365853658537 A 19.853658536585368 19.853658536585368 0 0 1 7.144114133755991 22.082145359989255 L 12.950879893629192 23.407501751992477 A 13.897560975609759 13.897560975609759 0 0 0 26.5 40.39756097560976 L 26.5 46.35365853658537 z"></path></g><g id="SvgjsG1271" class="apexcharts-series apexcharts-pie-series" seriesName="ActivexUsers" rel="3" data:realIndex="2"><path id="SvgjsPath1272" d="M 7.144114133755991 22.082145359989255 A 19.853658536585368 19.853658536585368 0 0 1 26.496534882917288 6.646341765803143 L 26.497574418042102 12.602439236062198 A 13.897560975609759 13.897560975609759 0 0 0 12.950879893629192 23.407501751992477 L 7.144114133755991 22.082145359989255 z" fill="rgba(90,141,238,1)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="77.14285714285711" data:startAngle="282.8571428571429" data:strokeWidth="2" data:value="30" data:pathOrig="M 7.144114133755991 22.082145359989255 A 19.853658536585368 19.853658536585368 0 0 1 26.496534882917288 6.646341765803143 L 26.497574418042102 12.602439236062198 A 13.897560975609759 13.897560975609759 0 0 0 12.950879893629192 23.407501751992477 L 7.144114133755991 22.082145359989255 z"></path></g></g></g></g><line id="SvgjsLine1273" x1="0" y1="0" x2="53" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1274" x1="0" y1="0" x2="53" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip dark"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 91, 92);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(130, 141, 153);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(90, 141, 238);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                      <!-- data-2 -->
                      <div class="statistics-data my-auto">
                        <div class="statistics">
                          <span class="font-medium-2 mr-50 text-bold-600">5,352</span><span class="text-danger">(-4.9%)</span>
                        </div>
                        <div class="statistics-date">
                          <i class="bx bx-radio-circle font-small-1 text-success mr-25"></i>
                          <small class="text-muted">Jul 26, 2019</small>
                        </div>
                      </div>
                    <div class="resize-triggers"><div class="expand-trigger"><div style="width: 191px; height: 76px;"></div></div><div class="contract-trigger"></div></div></div>
                  </div>
                </div>
                <div class="col-md-3 col-12 text-md-right">
                  <button class="btn btn-sm btn-primary glow mt-md-2 mb-1">View Report</button>
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive ps ps--active-x">
            <!-- table start -->
            <table id="table-marketing-campaigns" class="table table-borderless table-marketing-campaigns mb-0">
              <thead>
                <tr>
                  <th>Campaign</th>
                  <th>Growth</th>
                  <th>Charges</th>
                  <th>Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="py-1 line-ellipsis">
                    <img class="rounded-circle mr-1" src="images/icon/fs.png" alt="card" height="24" width="24">Fastrack Watches
                  </td>
                  <td class="py-1">
                    <i class="bx bx-trending-up text-success align-middle mr-50"></i><span>30%</span>
                  </td>
                  <td class="py-1">$5,536</td>
                  <td class="text-success py-1">Active</td>
                  <td class="text-center py-1">
                    <div class="dropdown">
                      <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                        <a class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 line-ellipsis">
                    <img class="rounded-circle mr-1" src="images/icon/puma.png" alt="card" height="24" width="24">Puma Shoes
                  </td>
                  <td class="py-1">
                    <i class="bx bx-trending-down text-danger align-middle mr-50"></i><span>15.5%</span>
                  </td>
                  <td class="py-1">$1,569</td>
                  <td class="text-success py-1">Active</td>
                  <td class="text-center py-1">
                    <div class="dropdown">
                      <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                      </span>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                        <a class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 line-ellipsis">
                    <img class="rounded-circle mr-1" src="images/icon/nike.png" alt="card" height="24" width="24">Nike Air Jordan
                  </td>
                  <td class="py-1">
                    <i class="bx bx-trending-up text-success align-middle mr-50"></i><span>70.30%</span>
                  </td>
                  <td class="py-1">$23,859</td>
                  <td class="text-danger py-1">Closed</td>
                  <td class="text-center py-1">
                    <div class="dropdown">
                      <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                      </span>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                        <a class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 line-ellipsis">
                    <img class="rounded-circle mr-1" src="images/icon/one-plus.png" alt="card" height="24" width="24">Oneplus 7 pro
                  </td>
                  <td class="py-1">
                    <i class="bx bx-trending-up text-success align-middle mr-50"></i><span>10.4%</span>
                  </td>
                  <td class="py-1">$9,523</td>
                  <td class="text-success py-1">Active</td>
                  <td class="text-center py-1">
                    <div class="dropdown">
                      <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                      </span>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                        <a class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 line-ellipsis">
                    <img class="rounded-circle mr-1" src="images/icon/google.png" alt="card" height="24" width="24">Google Pixel 4 xl
                  </td>
                  <td class="py-1"><i class="bx bx-trending-down text-danger align-middle mr-50"></i><span>-62.38%</span>
                  </td>
                  <td class="py-1">12,897</td>
                  <td class="text-danger py-1">Closed</td>
                  <td class="text-center py-1">
                    <div class="dropup">
                      <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                      </span>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                        <a class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            <!-- table ends -->
          <div class="ps__rail-x" style="width: 629px; left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 570px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
        </div>
      </div>
    </div>
</section>
	
@endsection