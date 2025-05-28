<?php
function sum($a, $b) {
    return $a + $b;
}

// echo sum(5, 10) . "\n";
echo sum(5, 10) . PHP_EOL;




$siblings=["abi","noel","josi","marlene"];
print $siblings[0] . "\n";

$user= [
	"name"=>"wasabi",
	"role"=>"dev intern",
	"stack"=>"php"
];
echo $user["name"] . "\n";
?>


<?php
if (isset($_GET['ajax'])) {
    //handling AJAX request
    $q = strtolower($_GET['q']);
    $suggestions = ["book", "pens", "sweets", "tiles", "chairs", "shelves"];

    $results = array_filter($suggestions, function($item) use ($q) {
        return strpos(strtolower($item), $q) !== false;
    });

    if (!empty($results)) {
        foreach ($results as $item) {
            echo "<div>" . htmlspecialchars($item) . "</div>";
        }
    } else {
        echo "<div style='color: gray;'>No suggestion found</div>";
    }
    exit; //stops further loading/execution
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Products</title>
    <style>
        #suggestions {
            margin: 0 auto;
            display: block;
        }
        #search {
            margin: 0 auto;
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <input 
         type="text" 
         id="search" 
         onkeyup="searchSuggestions()" 
         placeholder="Search...">
    <div id="suggestions"></div>

    <script>
        function searchSuggestions() {
            let query = document.getElementById('search').value;

            if (query !== "") {
                const xhr = new XMLHttpRequest();
                xhr.open("GET", "index.php?ajax=1&q=" + encodeURIComponent(query), true);
                xhr.onload = function () {
                    if (this.status === 200) {
                        document.getElementById("suggestions").innerHTML = this.responseText;
                    }
                };
                xhr.send();
            } else {
                document.getElementById("suggestions").innerHTML = "";
            }
        }
    </script>
</body>
</html>

<?php

function timetable() {
	$weekDays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
	echo "Input their names separated by commas: ";
	$input = trim(fgets(STDIN));
	$names = array_map('trim', explode(",", $input));

    shuffle($names); //randomize

    //Initialize the timetable
    $timetable = array_fill_keys($weekDays, []);

    //Distributing names
    foreach ($names as $index => $name) {
        $day = $weekDays[$index % count($weekDays)];
        $timetable[$day][] = $name;
    }

    //result
    foreach ($timetable as $day => $people) {
        echo "$day: " . implode(", ", $people) . PHP_EOL;
    }
}
timetable()
?>