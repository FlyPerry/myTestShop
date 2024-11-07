<?php
use Yii;
?>
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
