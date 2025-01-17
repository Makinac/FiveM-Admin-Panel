<div class="table-container">
    <div class="table-header">
        <h2>User Management</h2>
        <button class="btn-new-user text-button">New User</button>
    </div>
    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 

                foreach ($users as $user): 

                $permissionsCount = $user['master'] ? 'Master Account' : count($user['permissions']);
                
                ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars(string: $permissionsCount) ?></td>
                    <td>
                        <button class="btn-edit" onclick="window.location.href='/edit-user/<?= $user['id'] ?>'">Edit</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="new-user-modal" class="modal hidden">
    <div class="modal-content">
        <h2>Create New User</h2>
        <form id="new-user-form">
            <input type="text" id="username" name="username" placeholder="Enter username" required>

            <h3>Permissions:</h3>
            <div class="permissions-grid">
                <div class="checkbox-container">
                    <input type="checkbox" id="view-profile" name="permissions" value="View Profile">
                    <label for="view-profile">View Profile</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="edit-profile" name="permissions" value="Edit Profile">
                    <label for="edit-profile">Edit Profile</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="privacy-settings" name="permissions" value="Privacy Settings">
                    <label for="privacy-settings">Privacy Settings</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="view-settings" name="permissions" value="View Settings">
                    <label for="view-settings">View Settings</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="view-help" name="permissions" value="View Help">
                    <label for="view-help">View Help</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="manage-users" name="permissions" value="Manage Users">
                    <label for="manage-users">Manage Users</label>
                </div>
            </div>
            <br>
            <button class="modal-content-submit" type="submit">Create User</button>
        </form>
        <button id="close-new-user-modal" class="close-button">&times;</button>
    </div>
</div>

