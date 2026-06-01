<?php
// This is a single-file, full-stack-like application example.
// It demonstrates a simple web application with both frontend (HTML/CSS) and backend (PHP logic)
// components, simulating data storage. This type of application, though minimal,
// represents the kind of project that would be deployed to a cloud environment as described in the article.

session_start(); // Start a session to simulate persistent data storage (like a database)

// --- Backend Logic ---
// This section handles data processing, similar to a backend API. It processes incoming requests
// and manages the application's state (in this case, a list of items).
if (!isset($_SESSION['items'])) {
    $_SESSION['items'] = []; // Initialize an empty array to store items if it doesn't exist
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_name'])) {
    $itemName = htmlspecialchars(trim($_POST['item_name']));
    if (!empty($itemName)) {
        $_SESSION['items'][] = $itemName; // Add new item to our simulated database (session)
        // Redirect to prevent form resubmission on refresh, a common backend practice
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

// --- Frontend Presentation ---
// This section generates the HTML for the user interface. It consumes data prepared by the backend
// and provides input mechanisms for users.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Full-Stack App</title>
    <style>
        body { font-family: sans-serif; margin: 2em; background-color: #f4f4f4; color: #333; }
        .container { max-width: 600px; margin: 0 auto; background-color: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #0056b3; }
        form { display: flex; margin-bottom: 1.5em; }
        input[type="text"] { flex-grow: 1; padding: 0.8em; border: 1px solid #ccc; border-radius: 4px 0 0 4px; font-size: 1em; }
        button { padding: 0.8em 1.2em; background-color: #007bff; color: white; border: none; border-radius: 0 4px 4px 0; cursor: pointer; font-size: 1em; }
        button:hover { background-color: #0056b3; }
        ul { list-style: none; padding: 0; }
        li { background-color: #e9ecef; margin-bottom: 0.5em; padding: 0.8em; border-radius: 4px; display: flex; justify-content: space-between; align-items: center; }
        li:nth-child(even) { background-color: #f8f9fa; }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Simple Full-Stack Project</h1>
        <p>Add items to the list below. This demonstrates a basic interaction between a frontend (HTML/CSS) and a backend (PHP logic) within a single file, simulating a full-stack application that could be deployed to the cloud.</p>

        <!-- Frontend: Form to add new items -->
        <form method="POST" action="">
            <input type="text" name="item_name" placeholder="Enter a new item" required>
            <button type="submit">Add Item</button>
        </form>

        <h2>Current Items:</h2>
        <!-- Frontend: Displaying items retrieved from the backend (session data) -->
        <ul>
            <?php if (empty($_SESSION['items'])): ?>
                <li>No items yet. Add one above!</li>
            <?php else: ?>
                <?php foreach ($_SESSION['items'] as $index => $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
