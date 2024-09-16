<style>
    body {
        font-family: 'Roboto', sans-serif;
    }
    .sidebar {
        background-color: #343a40;
        padding: 20px;
        height: 100vh;
        color: white;
    }
    .sidebar h2 {
        font-weight: bold;
        margin-bottom: 20px;
    }
    .sidebar .nav-link {
        color: white;
        font-size: 18px;
        margin-bottom: 10px;
    }
    .sidebar .nav-link.active, .sidebar .nav-link:hover {
        background-color: #495057;
        border-radius: 5px;
    }
    .content {
        padding: 20px;
    }
    .content h3 {
        font-weight: bold;
        margin-bottom: 20px;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 sidebar">
            <h2>Admin Panel</h2>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a href="#dashboard-tab" class="nav-link active" data-bs-toggle="pill"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="#users-tab" class="nav-link" data-bs-toggle="pill"><i class="fas fa-users"></i> Users</a>
                </li>
                <li class="nav-item">
                    <a href="#catalog-tab" class="nav-link" data-bs-toggle="pill"><i class="fas fa-book"></i> Catalog</a>
                </li>
                <li class="nav-item">
                    <a href="#moderate-requests-tab" class="nav-link" data-bs-toggle="pill"><i class="fas fa-gavel"></i> Moderate Requests</a>
                </li>
            </ul>
        </div>
        <div class="col-md-9 col-lg-10 content tab-content">
            <div class="tab-pane fade show active" id="dashboard-tab">
                <h3>Dashboard</h3>
                <p>Welcome to the admin dashboard. Here you can view statistics, recent activities, and more.</p>
                <p>Recent Activities:</p>
                <ul>
                    <li>User JohnDoe logged in.</li>
                    <li>New book "Bootstrap Basics" added to the catalog.</li>
                    <li>User JaneDoe requested moderation for "Advanced CSS" course.</li>
                </ul>
            </div>
            <div class="tab-pane fade" id="users-tab">
                <h3>Users</h3>
                <p>Manage all users from this section.</p>
                <p>List of Users:</p>
                <ul>
                    <li>JohnDoe - johndoe@example.com <span class="user-actions"><button class="btn btn-danger btn-sm">Block</button><button class="btn btn-warning btn-sm">Edit</button><button class="btn btn-info btn-sm">View</button></span></li>
                    <li>JaneDoe - janedoe@example.com <span class="user-actions"><button class="btn btn-danger btn-sm">Block</button><button class="btn btn-warning btn-sm">Edit</button><button class="btn btn-info btn-sm">View</button></span></li>
                    <li>MikeSmith - mikesmith@example.com <span class="user-actions"><button class="btn btn-danger btn-sm">Block</button><button class="btn btn-warning btn-sm">Edit</button><button class="btn btn-info btn-sm">View</button></span></li>
                </ul>
            </div>
            <div class="tab-pane fade" id="catalog-tab">
                <h3>Catalog</h3>
                <p>Manage your catalog from this section.</p>
                <p>Catalog Items:</p>
                <ul>
                    <li>Book: "Bootstrap Basics" - Author: Jane Doe</li>
                    <li>Course: "Advanced CSS" - Instructor: John Smith</li>
                    <li>Book: "JavaScript Essentials" - Author: Mike Johnson</li>
                </ul>
            </div>
            <div class="tab-pane fade" id="moderate-requests-tab">
                <h3>Moderate Requests</h3>
                <p>Moderate user requests from this section.</p>
                <p>Pending Requests:</p>
                <ul>
                    <li>JaneDoe requested moderation for "Advanced CSS" course.</li>
                    <li>JohnDoe requested removal of "Old HTML Course".</li>
                </ul>
            </div>
        </div>
    </div>
</div>
