<?php
require_once '../config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJSONResponse(false, 'Invalid request method');
}

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    $data = $_POST;
}

// Validate required fields
if (empty($data['service_type']) || empty($data['full_name'])) {
    sendJSONResponse(false, 'Service type and full name are required');
}

$serviceType = sanitizeInput($data['service_type']);
$fullName = sanitizeInput($data['full_name']);
$email = !empty($data['email']) ? filter_var($data['email'], FILTER_SANITIZE_EMAIL) : null;
$phone = !empty($data['phone']) ? sanitizeInput($data['phone']) : null;
$userId = isLoggedIn() ? $_SESSION['user_id'] : null;

// Validate service type
$allowedServices = ['doctor', 'donation', 'tree_plantation', 'animal_welfare', 'food_support', 'farmer'];
if (!in_array($serviceType, $allowedServices)) {
    sendJSONResponse(false, 'Invalid service type');
}

$conn = getDBConnection();

// Start transaction
$conn->begin_transaction();

try {
    // Insert main application
    $stmt = $conn->prepare("INSERT INTO service_applications (user_id, service_type, full_name, email, phone, application_data, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
    $applicationData = json_encode($data);
    $stmt->bind_param("isssss", $userId, $serviceType, $fullName, $email, $phone, $applicationData);
    $stmt->execute();
    $applicationId = $conn->insert_id;
    $stmt->close();

    // Insert service-specific data
    switch ($serviceType) {
        case 'doctor':
            if (!empty($data['specialization']) && !empty($data['medical_license']) && !empty($data['availability'])) {
                $stmt = $conn->prepare("INSERT INTO doctor_applications (application_id, specialization, medical_license, availability) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("isss", $applicationId, $data['specialization'], $data['medical_license'], $data['availability']);
                $stmt->execute();
                $stmt->close();
            }
            break;
            
        case 'donation':
            if (!empty($data['donation_type']) && !empty($data['amount_items'])) {
                $stmt = $conn->prepare("INSERT INTO donation_applications (application_id, donation_type, amount_items) VALUES (?, ?, ?)");
                $stmt->bind_param("iss", $applicationId, $data['donation_type'], $data['amount_items']);
                $stmt->execute();
                $stmt->close();
            }
            break;
            
        case 'farmer':
            if (!empty($data['crops_animals']) && !empty($data['help_needed']) && !empty($data['area_village'])) {
                $stmt = $conn->prepare("INSERT INTO farmer_applications (application_id, crops_animals, help_needed, area_village) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("isss", $applicationId, $data['crops_animals'], $data['help_needed'], $data['area_village']);
                $stmt->execute();
                $stmt->close();
            }
            break;
            
        case 'animal_welfare':
            if (!empty($data['interest_area']) && !empty($data['availability'])) {
                $stmt = $conn->prepare("INSERT INTO animal_welfare_applications (application_id, interest_area, availability) VALUES (?, ?, ?)");
                $stmt->bind_param("iss", $applicationId, $data['interest_area'], $data['availability']);
                $stmt->execute();
                $stmt->close();
            }
            break;
            
        case 'food_support':
            if (!empty($data['participation_type']) && !empty($data['preferred_location'])) {
                $stmt = $conn->prepare("INSERT INTO food_support_applications (application_id, participation_type, preferred_location) VALUES (?, ?, ?)");
                $stmt->bind_param("iss", $applicationId, $data['participation_type'], $data['preferred_location']);
                $stmt->execute();
                $stmt->close();
            }
            break;
            
        case 'tree_plantation':
            // Tree plantation can just use the main application_data field
            break;
    }

    $conn->commit();
    $conn->close();
    
    sendJSONResponse(true, 'Application submitted successfully', ['application_id' => $applicationId]);
    
} catch (Exception $e) {
    $conn->rollback();
    $conn->close();
    sendJSONResponse(false, 'Failed to submit application: ' . $e->getMessage());
}
?>
