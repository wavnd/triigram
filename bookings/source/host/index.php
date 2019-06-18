<?php
    include '../partials/sidebar.php';
?>
<style media="screen">
    .footer {
        position: fixed;
        bottom: 0;
    }
</style>

<link rel="stylesheet" href="/assets/css/overview-stats.css">

<div class="main" style="padding-bottom: 350px;">
    <h1>Overview Statistics</h1>
    <!-- Buttons to choose list or grid view -->
    <div class="os-row">
        <div class="os-card">
            <button class="btn" onclick="listView()"><i class="fa fa-bars"></i> List</button>
            <button class="btn" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>
        </div>
    </div>
    <br>
    <div class="os-row">
        <div class="os-column">
            <div class="os-card">
                <h2>Total Listings</h2>
                <h3>5 - Units</h3>
            </div>
        </div>
        <div class="os-column">
            <div class="os-card">
                <h2>Total Unit Bookings</h2>
                <h3>302 - Bokings</h3>
            </div>
        </div>
    </div>
    <div class="os-row">
        <div class="os-column">
            <div class="os-card">
                <h2>Units Occupied</h2>
                <h3>3 - Units</h3>
            </div>
        </div>
        <div class="os-column">
            <div class="os-card">
                <h2>Total Available Units</h2>
                <h3>2 - Units</h3>
            </div>
        </div>
    </div>

    <div class="os-row">
        <div class="os-column">
            <div class="os-card">
                <h2>Average Ratings</h2>
                <h3>8 Stars</h3>
            </div>
        </div>
        <div class="os-column">
            <div class="os-card">
                <h2>Total Occupants</h2>
                <h3>402 - Guest</h3>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="/assets/js/overview-stats.js"></script>
</div>

<?php
    include '../partials/footer.php';
?>
