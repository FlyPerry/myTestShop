<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 sidebar">
            <h2>Admin Panel</h2>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a href="#dashboard-tab" class="nav-link active" data-bs-toggle="pill"><i
                                class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="#users-tab" class="nav-link" data-bs-toggle="pill"><i class="fas fa-users"></i> Users</a>
                </li>
                <li class="nav-item">
                    <a href="#catalog-tab" class="nav-link" data-bs-toggle="pill"><i class="fas fa-book"></i>
                        Catalog</a>
                </li>
                <li class="nav-item">
                    <a href="#moderate-requests-tab" class="nav-link" data-bs-toggle="pill"><i class="fas fa-gavel"></i>
                        Moderate Requests</a>
                </li>
            </ul>
        </div>
        <div class="col-md-9 col-lg-10 content tab-content">
            <div class="tab-pane fade show active" id="dashboard-tab">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Catalog</h5>
                                <p class="card-text">Manage all items in the catalog.</p>
                                <a href="#" class="btn btn-light">View Catalog</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Users</h5>
                                <p class="card-text">Manage all registered users.</p>
                                <a href="#" class="btn btn-light">View Users</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Active Moderate Requests</h5>
                                <p class="card-text">Review and moderate incoming requests.</p>
                                <a href="#" class="btn btn-light">View Requests</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Settings</h5>
                                <p class="card-text">Adjust system settings and preferences.</p>
                                <a href="#" class="btn btn-light">View Settings</a>
                            </div>
                        </div>
                    </div>
                </div>

                <h2>Catalog Overview</h2>
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
            <div class="tab-pane fade" id="users-tab">
                <h3>Users</h3>
                <p>Manage all users from this section.</p>
                <p>List of Users:</p>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>MikeSmith</td>
                        <td>mikesmith@example.com</td>
                        <td class="user-actions">
                            <button class="btn btn-info btn-sm">View</button>
                            <button class="btn btn-warning btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Block</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>MikeSmith</td>
                        <td>mikesmith@example.com</td>
                        <td class="user-actions">
                            <button class="btn btn-info btn-sm">View</button>
                            <button class="btn btn-warning btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Block</button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>MikeSmith</td>
                        <td>mikesmith@example.com</td>
                        <td class="user-actions">
                            <button class="btn btn-info btn-sm">View</button>
                            <button class="btn btn-warning btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Block</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="catalog-tab">
                <h2>Admin Panel - Catalog</h2>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>User</th>
                        <th>Photo</th>
                        <th>Date Created</th>
                        <th>Verify</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>Item 15</td>
                        <td>Short description of item 15</td>
                        <td>user15</td>
                        <td><img src="https://placehold.co/100x100" alt="Detailed description of item 15's photo"
                                 class="img-thumbnail"></td>
                        <td>2023-10-15</td>
                        <td><span class="badge bg-success">Verified</span></td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a>
                            <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-ban"></i> Block</a>
                            <a href="#" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Accept</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="moderate-requests-tab">
                <h2>Moderators Table</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>User</th>
                        <th>Photo</th>
                        <th>Date Created</th>
                        <th>Verify</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Jane Doe</td>
                        <td>Senior Moderator</td>
                        <td>jane_doe</td>
                        <td><img src="https://placehold.co/50x50" alt="Portrait of Jane Doe with a neutral expression">
                        </td>
                        <td>2023-01-15</td>
                        <td><span class="badge bg-success">Verified</span></td>
                        <td>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Decline</button>
                            <button class="btn btn-success btn-sm"><i class="fas fa-check"></i> Accept</button>
                        </td>
                    </tr>
                    <tr>
                        <td>John Smith</td>
                        <td>Junior Moderator</td>
                        <td>john_smith</td>
                        <td><img src="https://placehold.co/50x50" alt="Portrait of John Smith smiling"></td>
                        <td>2023-02-10</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Decline</button>
                            <button class="btn btn-success btn-sm"><i class="fas fa-check"></i> Accept</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Emily Clark</td>
                        <td>Content Moderator</td>
                        <td>emily_clark</td>
                        <td><img src="https://placehold.co/50x50"
                                 alt="Portrait of Emily Clark with a friendly expression">
                        </td>
                        <td>2023-03-05</td>
                        <td><span class="badge bg-success">Verified</span></td>
                        <td>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Decline</button>
                            <button class="btn btn-success btn-sm"><i class="fas fa-check"></i> Accept</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Michael Lee</td>
                        <td>Technical Moderator</td>
                        <td>michael_lee</td>
                        <td><img src="https://placehold.co/50x50" alt="Portrait of Michael Lee wearing glasses"></td>
                        <td>2023-04-20</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Decline</button>
                            <button class="btn btn-success btn-sm"><i class="fas fa-check"></i> Accept</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Sarah Brown</td>
                        <td>Senior Moderator</td>
                        <td>sarah_brown</td>
                        <td><img src="https://placehold.co/50x50"
                                 alt="Portrait of Sarah Brown with a professional appearance"></td>
                        <td>2023-05-08</td>
                        <td><span class="badge bg-success">Verified</span></td>
                        <td>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Decline</button>
                            <button class="btn btn-success btn-sm"><i class="fas fa-check"></i> Accept</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
