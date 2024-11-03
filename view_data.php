<?php
$mysqli = new mysqli("sql109.infinityfree.com", "if0_37644309", "M9rsALD9Mo", "if0_37644309_data");

$link = $_GET['link'];
$result = $mysqli->query("SELECT data, returned_names FROM data_links WHERE link='$link'");
$row = $result->fetch_assoc();
$data = json_decode($row['data'], true);
$returned_names = json_decode($row['returned_names'], true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $opposite_gender = $gender == 'male' ? 'female' : 'male';

    $filtered_names = array_filter($data, function($user) use ($name, $opposite_gender, $returned_names) {
        return $user['gender'] == $opposite_gender && $user['name'] != $name && !in_array($user['name'], $returned_names);
    });

    if ($filtered_names) {
        $random_name = $filtered_names[array_rand($filtered_names)];
        $message = "Random name: " . $random_name['name'];

        $returned_names[] = $random_name['name'];
        $returned_names_json = json_encode($returned_names);
        $mysqli->query("UPDATE data_links SET returned_names='$returned_names_json' WHERE link='$link'");
    } else {
        $message = "No names available.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Random Name</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
    <img src="christmas_tree.gif" alt="Animated Christmas Tree" class="animated-tree">

        <h1>Get a Random Name</h1>

        <form method="POST">
            <input type="text" name="name" placeholder="Enter your name" required>
            <select name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <button type="submit">Get Random Name</button>
        </form>

        <?php if (isset($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        
    </div>
</body>
</html>
