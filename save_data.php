<?php
$mysqli = new mysqli("sql109.infinityfree.com", "if0_37644309", "M9rsALD9Mo", "if0_37644309_data");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $names = $_POST['names'];
    $genders = $_POST['genders'];

    if (count($names) === count($genders)) {
        $data = [];

        for ($i = 0; $i < count($names); $i++) {
            $data[] = [
                'name' => $mysqli->real_escape_string($names[$i]),
                'gender' => $mysqli->real_escape_string($genders[$i])
            ];
        }

        $unique_link = uniqid();
        $data_json = json_encode($data);

        $mysqli->query("INSERT INTO data_links (link, data) VALUES ('$unique_link', '$data_json')");

        $message = "Your unique link: <a href='view_data.php?link=$unique_link'>view here</a>";
    } else {
        $message = "Error: The number of names and genders must match.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Names</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
    <img src="christmas_tree.gif" alt="Animated Christmas Tree" class="animated-tree">

        <h1>Names Submitted Successfully!</h1>
        <?php if (isset($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
