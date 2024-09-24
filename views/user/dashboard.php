<?php
/**
 * @var $user \app\models\User
 * @var $userInfo \app\models\UserInfo
 * @var $active integer
 */
?>
<div class="tab-pane fade show active" id="dashboard-tab">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Catalog Overview</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Item Distribution</h5>
                </div>
                <div class="card-body">
                    <canvas id="catalogPieChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Quantity per Category</h5>
                </div>
                <div class="card-body">
                    <canvas id="catalogBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <h2>User Overview</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">User Roles</h5>
                </div>
                <div class="card-body">
                    <canvas id="userPieChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Users by Status</h5>
                </div>
                <div class="card-body">
                    <canvas id="userBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <h2>Active Moderate Requests</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Request Status</h5>
                </div>
                <div class="card-body">
                    <canvas id="requestsPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Catalog Pie Chart
        var ctx = document.getElementById('catalogPieChart').getContext('2d');
        var catalogPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Category 1', 'Category 2', 'Category 3'],
                datasets: [{
                    data: [10, 15, 20],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107']
                }]
            }
        });

        // Catalog Bar Chart
        var ctx = document.getElementById('catalogBarChart').getContext('2d');
        var catalogBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Category 1', 'Category 2', 'Category 3'],
                datasets: [{
                    label: 'Quantity',
                    data: [10, 15, 20],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107']
                }]
            }
        });

        // User Pie Chart
        var ctx = document.getElementById('userPieChart').getContext('2d');
        var userPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Admin', 'User', 'Moderator'],
                datasets: [{
                    data: [1, 1, 1],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107']
                }]
            }
        });

        // User Bar Chart
        var ctx = document.getElementById('userBarChart').getContext('2d');
        var userBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Active', 'Inactive'],
                datasets: [{
                    label: 'Users',
                    data: [2, 1],
                    backgroundColor: ['#007bff', '#28a745']
                }]
            }
        });

        // Requests Pie Chart
        var ctx = document.getElementById('requestsPieChart').getContext('2d');
        var requestsPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Pending', 'Approved', 'Rejected'],
                datasets: [{
                    data: [3, 0, 0],
                    backgroundColor: ['#007bff', '#28a745', '#dc3545']
                }]
            }
        });
    </script>
</div>
