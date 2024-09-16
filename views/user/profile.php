<?php
?>
<div class="tab-pane fade" id="users-tab">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="text-center">
                    <img src="https://placehold.co/150x150" alt="Profile picture of a person" class="profile-img">
                    <h2 class="mt-3">John Doe</h2>
                    <p class="text-muted">@johndoe</p>
                </div>
            </div>
            <div class="col-md-8">
                <h3>Edit Profile</h3>
                <form>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" value="John">
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" value="Doe">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" value="john.doe@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" value="@johndoe">
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control" id="bio" rows="3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="profilePicture" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" id="profilePicture">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
