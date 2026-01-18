<?php
require_once 'config.php';
requireLogin();

$currentUser = getCurrentUser();
$pageTitle = 'Dashboard';

// Get user's applications
$conn = getDBConnection();
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM service_applications WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$applications = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

$additionalCSS = [];
include 'includes/header.php';
?>

<section style="padding: 5rem 5%; min-height: 60vh;">
    <div class="container" style="max-width: 1200px; margin: 0 auto;">
        <h1 style="color: var(--primary-color); margin-bottom: 2rem;">Welcome, <?php echo htmlspecialchars($currentUser['full_name']); ?>!</h1>
        
        <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: var(--shadow); margin-bottom: 2rem;">
            <h2 style="margin-bottom: 1rem;">Your Profile</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                <div>
                    <strong>Username:</strong> <?php echo htmlspecialchars($currentUser['username']); ?>
                </div>
                <div>
                    <strong>Email:</strong> <?php echo htmlspecialchars($currentUser['email']); ?>
                </div>
                <div>
                    <strong>Phone:</strong> <?php echo htmlspecialchars($currentUser['phone']); ?>
                </div>
                <div>
                    <strong>Role:</strong> <?php echo ucfirst($currentUser['role']); ?>
                </div>
                <div>
                    <strong>District:</strong> <?php echo ucfirst($currentUser['district']); ?>
                </div>
            </div>
        </div>

        <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: var(--shadow);">
            <h2 style="margin-bottom: 1rem;">Your Applications</h2>
            <?php if (empty($applications)): ?>
                <p style="color: var(--text-light);">You haven't submitted any service applications yet.</p>
                <a href="services.php" class="primary-btn" style="display: inline-block; margin-top: 1rem;">Browse Services</a>
            <?php else: ?>
                <div style="display: grid; gap: 1rem;">
                    <?php foreach ($applications as $app): ?>
                        <div style="border: 1px solid #ddd; border-radius: 5px; padding: 1.5rem;">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.5rem;">
                                <h3 style="color: var(--primary-color); margin: 0;">
                                    <?php echo ucfirst(str_replace('_', ' ', $app['service_type'])); ?>
                                </h3>
                                <span style="
                                    padding: 0.3rem 0.8rem;
                                    border-radius: 20px;
                                    font-size: 0.85rem;
                                    font-weight: 600;
                                    background: <?php echo $app['status'] == 'approved' ? '#e8f5e9' : ($app['status'] == 'rejected' ? '#ffebee' : '#fff3e0'); ?>;
                                    color: <?php echo $app['status'] == 'approved' ? '#2e7d32' : ($app['status'] == 'rejected' ? '#c62828' : '#f57c00'); ?>;
                                ">
                                    <?php echo ucfirst($app['status']); ?>
                                </span>
                            </div>
                            <p style="color: var(--text-light); margin: 0.5rem 0;">
                                <strong>Submitted:</strong> <?php echo date('F j, Y g:i A', strtotime($app['created_at'])); ?>
                            </p>
                            <?php if ($app['email']): ?>
                                <p style="color: var(--text-light); margin: 0;">
                                    <strong>Contact:</strong> <?php echo htmlspecialchars($app['email']); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
